@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Karyawan</h3>

    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        + Tambah Karyawan
    </a>
</div>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>ID Karyawan</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($employees as $employee)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($employee->photo)
                        <img
                            src="{{ asset('uploads/employees/'.$employee->photo) }}"
                            width="60"
                            height="60"
                            class="rounded">
                        @else
                        <span class="badge bg-secondary">
                            No Photo
                        </span>
                        @endif
                    </td>

                    <td>{{ $employee->employee_id }}</td>

                    <td>{{ $employee->name }}</td>

                    <td>{{ $employee->department }}</td>

                    <td>{{ $employee->position }}</td>

                    <td>{{ $employee->email }}</td>

                    <td>
                        @if($employee->status == 'active')
                        <span class="badge bg-success">
                            Active
                        </span>
                        @else
                        <span class="badge bg-danger">
                            Inactive
                        </span>
                        @endif
                    </td>

                    <td>

                            <a
                            href="{{ route('employees.show', $employee->id) }}"
                            class="btn btn-info btn-sm"
                            title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a
                            href="{{ route('employees.edit', $employee->id) }}"
                            class="btn btn-warning btn-sm"
                            title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form
                            action="{{ route('employees.destroy', $employee->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="9" class="text-center">
                        Belum ada data karyawan
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>

    </div>
</div>

@endsection