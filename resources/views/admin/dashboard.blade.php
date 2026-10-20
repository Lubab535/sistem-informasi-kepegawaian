@extends('admin.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang!</h6>
            </div>
            <div class="card-body">
                <p>Integrasi template SB Admin 2 telah berhasil dilakukan pada Laravel 12.
                    Ini adalah konten dinamis yang dipanggil via Blade Template engine `@yield`.</p>
            </div>
        </div>
    </div>
</div>
@endsection