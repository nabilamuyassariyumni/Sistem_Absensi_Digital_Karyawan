@extends('layouts.employee')

@section('content')

<div class="employee-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            Profil Saya
        </h2>
    </div>
    <div class="row g-4">
        <!-- FOTO -->
        <div class="col-lg-4">
            <div class="employee-profile-card text-center">
                @if($employee->photo)
                <img
                    src="{{ asset('uploads/employees/'.$employee->photo) }}"
                    class="employee-detail-photo"
                    alt="Foto Karyawan">
                @else
                <img
                    src="https://via.placeholder.com/250x250?text=No+Photo"
                    class="employee-detail-photo"
                    alt="No Photo">
                @endif

                <h3 class="fw-bold mt-4 mb-1">
                    {{ $employee->name }}
                </h3>

                @if($employee->status == 'active')
                <span class="badge bg-success px-3 py-2">
                    Active
                </span>
                @else
                <span class="badge bg-danger px-3 py-2">
                    Inactive
                </span>
                @endif
            </div>
        </div>

        <!-- INFORMASI -->
        <div class="col-lg-8">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="info-card">
                        <span>ID Karyawan</span>
                        <h6>{{ $employee->employee_id }}</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <span>Email</span>
                        <h6>{{ $employee->email ?? '-' }}</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <span>No HP</span>
                        <h6>{{ $employee->phone ?? '-' }}</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <span>Departemen</span>
                        <h6>{{ $employee->department ?? '-' }}</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <span>Jabatan</span>
                        <h6>{{ $employee->position ?? '-' }}</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <span>Tanggal Bergabung</span>
                        <h6>
                            {{ $employee->join_date
                                ? \Carbon\Carbon::parse($employee->join_date)->translatedFormat('d F Y')
                                : '-' }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection