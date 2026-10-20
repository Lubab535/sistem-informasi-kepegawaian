@extends('admin.layouts.app')

@section('title', 'Departemen')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Departemen</h1>
        <p class="mb-0 text-muted">Kelola data departemen perusahaan.</p>
    </div>
    <a href="{{ route('departments.create') }}" class="btn btn-primary shadow-sm mt-3 mt-sm-0">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Departemen
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Departemen</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 70px">No.</th>
                        <th scope="col">Nama Departemen</th>
                        <th scope="col" style="width: 170px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departments as $department)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $department->name }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning btn-sm" aria-label="Edit {{ $department->name }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus departemen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" aria-label="Hapus {{ $department->name }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data departemen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection