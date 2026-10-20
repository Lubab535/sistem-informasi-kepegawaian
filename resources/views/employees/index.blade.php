@extends('admin.layouts.app')

@section('title', 'Pegawai')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Pegawai</h1>
        <p class="mb-0 text-muted">Kelola data pegawai perusahaan.</p>
    </div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary shadow-sm mt-3 mt-sm-0">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Pegawai
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 60px">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Departemen</th>
                        <th scope="col">Gaji</th>
                        <th scope="col">Tanggal Bergabung</th>
                        <th scope="col" style="width: 170px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td class="text-nowrap">Rp {{ number_format((float) $employee->salary, 0, ',', '.') }}</td>
                            <td class="text-nowrap">{{ \Illuminate\Support\Carbon::parse($employee->joined_at)->format('d/m/Y') }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm" aria-label="Edit {{ $employee->name }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pegawai ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" aria-label="Hapus {{ $employee->name }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data pegawai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
