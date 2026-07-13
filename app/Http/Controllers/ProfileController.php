<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        //mengambil data employee yang sedang login
        $employee = Auth::user()->employee;

        return view('attendances.profile', compact('employee'));
    }
}
