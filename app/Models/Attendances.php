<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'check_in',
        'check_out',
        'work_duration',
        'overtime_hours',
        'latitude',
        'longitude',
        'location',
        'status',
        'note'
    ];

    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
