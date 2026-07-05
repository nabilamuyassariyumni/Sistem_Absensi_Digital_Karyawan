<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $employeeId = request()->user()->employee->employee_id;

        $todayAttendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        $attendances = Attendances::where('employee_id', $employeeId)
            ->latest()
            ->get();

        $hadir = Attendances::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->count();

        $terlambat = Attendances::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->count();

        $izin = Attendances::where('employee_id', $employeeId)
            ->whereIn('status', ['leave'])
            ->count();

        $lembur = Attendances::where('employee_id', $employeeId)
            ->sum('overtime_duration');

        return view('attendances.index', compact(
            'todayAttendance',
            'attendances',
            'hadir',
            'terlambat',
            'izin',
            'lembur'
        ));
    }

    // Menyimpan data check in karyawan
    public function checkIn(Request $request)
    {
        $employeeId = request()->user()->employee->employee_id;

        $attendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        if ($attendance) {
            return back()->with('error', 'Anda sudah check in hari ini');
        }

        $status = now()->format('H:i:s') > '08:00:00'
            ? 'late'
            : 'present';

        $officeLat = -0.914840;
        $officeLng = 100.466690;

        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $officeLat,
            $officeLng
        );

        if ($distance > 6000) {

            return back()->with(
                'error',
                'Anda berada di luar radius absensi (6 KM)'
            );
        }

        Attendances::create([
            'employee_id' => $employeeId,
            'attendance_date' => today(),
            'check_in' => now()->format('H:i:s'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $status,
        ]);

        return back()->with('success', 'Check In berhasil');
    }

    // Menyimpan data check out karyawan
    public function checkOut(Request $request)
    {
        $employeeId = request()->user()->employee->employee_id;

        $attendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Silahkan Check In terlebih dahulu');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Anda sudah Check Out');
        }


        $checkIn = Carbon::parse($attendance->check_in);
        $checkOut = Carbon::now();

        $minutes = $checkIn->diffInMinutes($checkOut);
        $workDuration = round($minutes / 60, 2);

        $overtime = 0;

        if ($workDuration > 8) {
            $overtime = round($workDuration - 8, 2);
        }

        $attendance->update([
            'check_out' => $checkOut->format('H:i:s'),
            'work_duration' => $workDuration,
            'overtime_duration' => $overtime,
        ]);

        return back()->with('success', 'Check Out berhasil');
    }

    // Mendapatkan riwayat kehadiran karyawan
    public function history()
    {
        $employeeId = request()->user()->employee->employee_id;

        $attendances = Attendances::where('employee_id', $employeeId)
            ->latest('attendance_date')
            ->paginate(10);

        return view('attendances.history', compact('attendances'));
    }

    // Menghitung jarak antara dua titik koordinat (latitude dan longitude) dalam meter
    private function calculateDistance(
        $lat1,
        $lon1,
        $lat2,
        $lon2
    ) {

        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a =
            sin($dLat / 2) * sin($dLat / 2)
            +
            cos(deg2rad($lat1))
            *
            cos(deg2rad($lat2))
            *
            sin($dLon / 2)
            *
            sin($dLon / 2);

        $c = 2 * atan2(
            sqrt($a),
            sqrt(1 - $a)
        );

        return $earthRadius * $c;
    }
}
