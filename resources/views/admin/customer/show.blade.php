@extends('layouts.app', ['title' => 'Detail Customer'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user"></i> DETAIL CUSTOMER</h6>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Customer</label>
                        <input type="text" class="form-control" name="name" value="{{ $customer->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Customer</label>
                        <input type="email" class="form-control" name="email" value="{{ $customer->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Tanggal Bergabung</label>
                        <input type="text" class="form-control" name="created_at" value="{{ dateID($customer->created_at) }}" readonly>
                    </div>
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('admin.riwayat.show', ['id' => $customer->id]) }}" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Riwayat Pesanan</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
