<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Laporan Penjualan</h2>
    <p>
        @if($start_date)
            Tanggal Awal: {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }}<br>
        @endif
        @if($end_date)
            Tanggal Akhir: {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}<br>
        @endif
        @if($product)
            Produk: {{ $product }}<br>
        @endif
    </p>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 6%">NO.</th>
                <th>NAMA PELANGGAN</th>
                <th>NAMA PRODUK</th>
                <th>TANGGAL</th>
                <th class="text-center" style="width: 15%">GRAND TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $no => $invoice)
            <tr>
                <td class="text-center">{{ $no + 1 }}</td>
                <td>{{ $invoice->name }}</td>
                <td>
                    <ul>
                        @foreach($invoice->orders as $order)
                            <li>{{ $order->product_name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ dateID($invoice->created_at) }}</td>
                <td class="text-right">{{ moneyFormat($invoice->grand_total) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Data Belum Tersedia!</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Grand Total:</th>
                <th class="text-right">{{ moneyFormat($totalGrandTotal) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
