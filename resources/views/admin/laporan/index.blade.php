@extends('layouts.app', ['title' => 'Laporan'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-file"></i> LAPORAN</h6>
                </div>

                <div class="card-body">
                    <form id="filterForm" action="{{ route('admin.laporan.index') }}" method="GET">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Tanggal Awal" value="{{ request()->start_date }}">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Tanggal Akhir" value="{{ request()->end_date }}">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" name="product">
                                    <option value="">Pilih Produk</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->title }}" {{ request()->product == $product->title ? 'selected' : '' }}>
                                            {{ $product->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-search"></i> FILTER</button>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('filterForm').submit(); window.location='{{ route('admin.laporan.cetak') }}?start_date='+document.getElementById('start_date').value+'&end_date='+document.getElementById('end_date').value+'&product='+document.querySelector('[name=product]').value;" class="btn btn-secondary"><i class="fa fa-print"></i> CETAK</a>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NAMA PELANGGAN</th>
                                    <th scope="col">NAMA PRODUK</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col" style="width: 15%; text-align: center">GRAND TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $no => $invoice)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($invoices->currentPage()-1) * $invoices->perPage() }}
                                    </th>
                                    <td>{{ $invoice->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach($invoice->orders as $order)
                                                <li>{{ $order->product_name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ dateID($invoice->created_at) }}</td>
                                    <td>{{ moneyFormat($invoice->grand_total) }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Belum Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align: right;">Grand Total:</th>
                                    <th>{{ moneyFormat($totalGrandTotal) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div style="text-align: center">
                            {{ $invoices->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
<script>
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        // Ambil nilai dari input tanggal awal dan akhir
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        // Periksa apakah kedua tanggal sudah diisi
        if (!startDate || !endDate) {
            // Jika salah satu atau kedua tanggal belum diisi, mencegah pengiriman form
            event.preventDefault();
            alert('Silakan isi tanggal awal dan tanggal akhir.');
        }
    });

    function printReport() {
        window.print();
    }
</script>
@endpush
