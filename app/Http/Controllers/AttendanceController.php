<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendances::with('employee')->latest()->get();
        return view('attendances.index', compact('attendances'));
    }

    public function checkIn(Request $request)
    {
        $today = now()->toDateString();

        $attendance = Attendances::where('employee_id', $request->employee_id)
            ->where('attendance_date', $today)
            ->first();

        if ($attendance) {
            return back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        Attendances::create([
            'employee_id' => $request->employee_id,
            'attendance_date' => $today,
            'check_in' => now(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location' => $request->location,
            'status' => 'present',
        ]);

        return back()->with('success', 'Check-in berhasil.');
    }

    public function checkOut(Request $request)
    {
        $today = now()->toDateString();

        $attendance = Attendances::where('employee_id', $request->employee_id)
            ->where('attendance_date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Anda belum melakukan check-in hari ini.');
        }

        $checkIn = Carbon::parse($attendance->check_in); // Pastikan check_in di-parse sebagai Carbon instance
        $checkOut = Carbon::now(); // Gunakan Carbon untuk mendapatkan waktu saat ini

        $hours = $checkIn->diffInHours($checkOut) / 60; // Hitung durasi kerja dalam jam
        $overtime = 0; // Inisialisasi overtime

        if ($hours > 8) {
            $overtime = $hours - 8; // Hitung jam lembur
        }

    $attendance->update([
        'check_out' => now()->format('H:i:s'), // Simpan waktu check-out dalam format jam:menit:detik
        'work_duration' => round($hours, 2), // Simpan durasi kerja dalam jam
        'overtime_hours' => round($overtime, 2), // Simpan jam lembur
    ]);

        return back()->with('success', 'Check-out berhasil.');
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->month ?? date('m'); // Ambil bulan dari request atau gunakan bulan saat ini
        $year = $request->year ?? date('Y'); // Ambil tahun dari request atau gunakan tahun saat ini
        $attendances = Attendances::with('employee')
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->get();

        return view('attendances.monthly_report', compact('attendances', 'month', 'year')); // Pastikan view ini sudah dibuat
    }
}
