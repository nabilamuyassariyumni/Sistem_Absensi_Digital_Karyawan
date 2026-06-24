@extends('layouts.sidebar')

@section('content')

<div class="page-header mb-4">

    <div>
        <h2 class="page-title">Edit Karyawan</h2>
        <p class="page-subtitle">
            Perbarui informasi data karyawan
        </p>
    </div>

    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

</div>

<div class="card employee-card border-0 shadow-sm">

    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- FORM KIRI -->
                <div class="col-lg-8">

                    <h5 class="section-title mb-4">
                        <i class="bi bi-person-circle"></i>
                        Informasi Karyawan
                    </h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">ID Karyawan</label>

                            <input type="text"
                                name="employee_id"
                                class="form-control"
                                value="{{ old('employee_id', $employee->employee_id) }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. HP</label>

                            <input type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $employee->phone) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Karyawan</label>

                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $employee->name) }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Bergabung</label>

                            <input type="date"
                                name="join_date"
                                class="form-control"
                                value="{{ old('join_date', $employee->join_date) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Departemen</label>

                            <input type="text"
                                name="department"
                                class="form-control"
                                value="{{ old('department', $employee->department) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">

                                <option value="active"
                                    {{ $employee->status == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive"
                                    {{ $employee->status == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>

                            <input type="text"
                                name="position"
                                class="form-control"
                                value="{{ old('position', $employee->position) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>

                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $employee->email) }}">
                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit"
                            class="btn btn-warning">
                            <i class="bi bi-save"></i>
                            Update Karyawan
                        </button>

                        <a href="{{ route('employees.index') }}"
                            class="btn btn-light">
                            Batal
                        </a>

                    </div>

                </div>

                <!-- FOTO KANAN -->
                <div class="col-lg-4">

                    <div class="photo-card">

                        <h6 class="mb-3">
                            Foto Karyawan
                        </h6>

                        <div class="text-center mb-4">

                            @if($employee->photo)

                            <img src="{{ asset('uploads/employees/'.$employee->photo) }}"
                                class="current-photo">

                            @else

                            <div class="no-photo">
                                <i class="bi bi-person"></i>
                            </div>

                            @endif

                        </div>

                        <label class="form-label">
                            Ganti Foto
                        </label>

                        <input type="file"
                            name="photo"
                            class="form-control"
                            accept="image/*">

                        <div class="info-box mt-4">

                            <h6>
                                <i class="bi bi-info-circle"></i>
                                Informasi
                            </h6>
                            <ul>
                                <li>Foto bersifat opsional</li>
                                <li>Format JPG / PNG</li>
                                <li>Maksimal ukuran 2MB</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection