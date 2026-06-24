@extends('layouts.main')

@section('content')

<div class="page-header mb-4">

    <div>
        <h2 class="page-title">Data Karyawan</h2>
        <p class="page-subtitle">
            Kelola data seluruh karyawan perusahaan
        </p>
    </div>

    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Karyawan
    </a>

</div>

<div class="card employee-card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle employee-table">

                <thead>
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
                                width="50"
                                height="50"
                                class="employee-photo">

                            @else

                            <span class="badge bg-secondary">
                                No Photo
                            </span>

                            @endif

                        </td>

                        <td>{{ $employee->employee_id }}</td>

                        <td class="fw-semibold">
                            {{ $employee->name }}
                        </td>

                        <td>{{ $employee->department }}</td>

                        <td>{{ $employee->position }}</td>

                        <td>{{ $employee->email }}</td>

                        <td>

                            @if($employee->status == 'active')

                            <span class="badge status-active">
                                Active
                            </span>

                            @else

                            <span class="badge status-inactive">
                                Inactive
                            </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('employees.show', $employee->id) }}"
                                class="btn btn-light btn-sm"
                                title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a
                                href="{{ route('employees.edit', $employee->id) }}"
                                class="btn btn-warning btn-sm"
                                title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('employees.destroy', $employee->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center py-4">
                            Belum ada data karyawan
                        </td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection