<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'employee_id',
        'name',
        'department',
        'position',
        'email',
        'phone',
        'join_date',
        'photo',
        'status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendances::class, 'employee_id', 'employee_id');
    }

    public function user()
    {
        return $this->hasOne(
            User::class,
            'employee_id',
            'employee_id'
        );
    }
}
