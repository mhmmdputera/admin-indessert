@extends('layouts.app', ['title' => 'Riwayat Pesanan Customer'])

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-history"></i> RIWAYAT PESANAN CUSTOMER</h6>
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
                    <a href="{{ route('admin.riwayat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Order History -->
    <div class="row mt-4">
        <div class="col-md-12">
            @foreach ($invoices as $invoice)
            <div class="card border-0 shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Invoice: {{ $invoice->invoice_number }}</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @forEach ($invoice->orders as $order)
                            <p>Produk       : {{ $order->product_name }}</p>
                            <p>Quantity       : {{ $order->qty }}</p>
                            @endforeach
                            <p>Status       : {{ $invoice->status }}</p>
                            <p>Grand Total  : {{ moneyFormat($invoice->grand_total) }}</p>
                            <p>Tanggal      : {{ dateID($invoice->created_at) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status History:</h5>
                            <div id="timeline" class="timeline">
                                @foreach ($invoice->statusHistories as $statusHistory)
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p>{{ $statusHistory->status }} at {{ $statusHistory->created_at }}</p>
                                    </div>
                                </div>
                                
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<!-- Styles for Timeline -->
<style>
    .timeline {
    padding: 0;
    list-style: none;
    position: relative; /* Tambahkan properti position */
}

.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #007bff;
    left: 20px;
    margin-right: -2px; /* Hapus properti margin-right */
}

.timeline-item {
    margin-bottom: 20px;
    position: relative;
    padding-left: 40px; /* Ubah padding-left */
}

.timeline-icon {    
    right: 7px; /* Sesuaikan posisi horizontal titik biru */
    top: 10px; /* Sesuaikan posisi vertikal titik biru */    
    border-radius: 50%;
    width: 14px;
    height: 14px;
    z-index: 100;
    position: relative;
    top: 30px;
}


.timeline-content {
    margin-left: 20px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 3px;
    position: relative; /* Tetapkan posisi relatif */
}
</style>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var timeline = document.getElementById('timeline');
    var timelineItems = timeline.getElementsByClassName('timeline-item');
    var timelineItemsArray = Array.from(timelineItems);

    timelineItemsArray.reverse(); // Membalikkan urutan elemen

    // Memasukkan kembali elemen dengan urutan yang sudah dibalik
    timelineItemsArray.forEach(function(item) {
        timeline.appendChild(item);
    });
});

</script>
