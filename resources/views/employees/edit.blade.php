@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Edit Karyawan</h4>
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

        <form action="{{ route('employees.update', $employee->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">ID Karyawan</label>
                <input type="text"
                       name="employee_id"
                       class="form-control"
                       value="{{ old('employee_id', $employee->employee_id) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $employee->name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Departemen</label>
                <input type="text"
                       name="department"
                       class="form-control"
                       value="{{ old('department', $employee->department) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text"
                       name="position"
                       class="form-control"
                       value="{{ old('position', $employee->position) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $employee->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $employee->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input type="date"
                       name="join_date"
                       class="form-control"
                       value="{{ old('join_date', $employee->join_date) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label>
                <br>

                @if($employee->photo)
                    <img src="{{ asset('uploads/employees/'.$employee->photo) }}"
                         width="120"
                         class="img-thumbnail">
                @else
                    <span class="badge bg-secondary">
                        Tidak ada foto
                    </span>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Foto</label>
                <input type="file"
                       name="photo"
                       class="form-control"
                       accept="image/*">
            </div>

            <div class="mb-3">
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

            <button type="submit" class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('employees.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection