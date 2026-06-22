@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Tambah Karyawan</h4>
    </div>

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

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">ID Karyawan</label>
                <input
                    type="text"
                    name="employee_id"
                    class="form-control"
                    value="{{ old('employee_id') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Departemen</label>
                <input
                    type="text"
                    name="department"
                    class="form-control"
                    value="{{ old('department') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input
                    type="text"
                    name="position"
                    class="form-control"
                    value="{{ old('position') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input
                    type="date"
                    name="join_date"
                    class="form-control"
                    value="{{ old('join_date') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input
                    type="file"
                    name="photo"
                    class="form-control"
                    accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection