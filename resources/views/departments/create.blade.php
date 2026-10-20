@extends('admin.layouts.app')

@section('title', 'Tambah Departemen')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Departemen</h1>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary btn-sm mt-3 mt-sm-0">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Departemen</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    @include('departments._form', ['buttonLabel' => 'Simpan'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection