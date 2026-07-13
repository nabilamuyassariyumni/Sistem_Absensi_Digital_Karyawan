@extends('layouts.sidebar')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Detail Karyawan</h4>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card-body">

        <div class="row g-4">

            <!-- FOTO KARYAWAN -->
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

                    <h4 class="mt-3 mb-1 fw-bold">
                        {{ $employee->name }}
                    </h4>

                    <p class="text-muted mb-2">
                        {{ $employee->position ?? '-' }}
                    </p>

                    <p class="text-muted">
                        {{ $employee->department ?? '-' }}
                    </p>

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

                    <div class="col-md-6">
                        <div class="info-card">
                            <span>Dibuat Pada</span>
                            <h6>
                                {{ $employee->created_at->format('d-m-Y H:i') }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card">
                            <span>Terakhir Diubah</span>
                            <h6>
                                {{ $employee->updated_at->format('d-m-Y H:i') }}
                            </h6>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection