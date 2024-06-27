@extends('layouts.app', ['title' => 'Daftar Riwayat Pelanggan'])

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-history"></i> DAFTAR RIWAYAT PESANAN PELANGGAN</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Order Terakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $no => $customer)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($customers->currentPage()-1) * $customers->perPage() }}</th>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        @if($customer->invoices->isNotEmpty())
                                            {{ dateID($customer->invoices->first()->created_at)}}
                                        @else
                                            Belum ada pemesanan
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.riwayat.show', $customer->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Riwayat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
