@extends('admin.layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Pegawai</h1>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm mt-3 mt-sm-0">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Perbarui Informasi Pegawai</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('employees._form', ['buttonLabel' => 'Simpan Perubahan'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
