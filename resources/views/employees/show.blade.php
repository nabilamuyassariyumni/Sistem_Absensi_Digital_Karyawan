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

        <div class="row">

            <div class="col-md-3 text-center">

                @if($employee->photo)
                <img
                    src="{{ asset('uploads/employees/'.$employee->photo) }}"
                    class="img-fluid rounded shadow"
                    alt="Foto Karyawan">
                @else
                <img
                    src="https://via.placeholder.com/250x250?text=No+Photo"
                    class="img-fluid rounded shadow"
                    alt="No Photo">
                @endif

            </div>

            <div class="col-md-9">

                <table class="table table-bordered">

                    <tr>
                        <th width="200">ID Karyawan</th>
                        <td>{{ $employee->employee_id }}</td>
                    </tr>

                    <tr>
                        <th>Nama</th>
                        <td>{{ $employee->name }}</td>
                    </tr>

                    <tr>
                        <th>Departemen</th>
                        <td>{{ $employee->department ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $employee->position ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $employee->email ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>No HP</th>
                        <td>{{ $employee->phone ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal Bergabung</th>
                        <td>
                            {{ $employee->join_date
                                ? \Carbon\Carbon::parse($employee->join_date)->format('d-m-Y')
                                : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
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
                    </tr>

                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $employee->created_at->format('d-m-Y H:i') }}</td>
                    </tr>

                    <tr>
                        <th>Terakhir Diubah</th>
                        <td>{{ $employee->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection