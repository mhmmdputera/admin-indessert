<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * index
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $invoices = collect(); // Set default to empty collection
        $totalGrandTotal = 0;

        // Validasi input tanggal awal dan akhir
        $request->validate([
            'start_date' => 'required_with:end_date|date',
            'end_date' => 'required_with:start_date|date',
        ]);

        // Default empty paginator
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $defaultPaginator = new \Illuminate\Pagination\LengthAwarePaginator([], 0, $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // Check if any filter is applied
        if ($request->has('start_date') || $request->has('end_date') || $request->has('product') || $request->has('q')) {
            $query = Invoice::with('orders')->where('status', 'success'); // Filter by status success

            // Filter berdasarkan tanggal awal dan akhir
            if ($request->has('start_date') && $request->start_date) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->has('end_date') && $request->end_date) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            // Filter berdasarkan nama produk
            if ($request->has('product') && $request->product) {
                $query->whereHas('orders', function ($q) use ($request) {
                    $q->where('product_name', 'like', '%' . $request->product . '%');
                });
            }

            // Filter berdasarkan nomor invoice
            if ($request->has('q') && $request->q) {
                $query->where('invoice', 'like', '%' . $request->q . '%');
            }

            $invoices = $query->paginate(10);

            // Menghitung total grand_total dari hasil filter
            $totalGrandTotal = $query->sum('grand_total');
        } else {
            $invoices = $defaultPaginator;
        }

        // Mengambil daftar produk
        $products = Product::all();

        return view('admin.laporan.index', compact('invoices', 'totalGrandTotal', 'products'));
    }

     /**
     * cetak
     *
     * @param Request $request
     * @return void
     */
    public function cetak(Request $request)
    {
        // Ambil data filter dari request
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $product = $request->get('product');

        // Dapatkan data laporan berdasarkan filter dan status success
        $query = Invoice::where('status', 'success'); // Filter by status success

        if ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        if ($product) {
            $query->whereHas('orders', function($q) use ($product) {
                $q->where('product_name', $product);
            });
        }

        $invoices = $query->get();
        $totalGrandTotal = $invoices->sum('grand_total');

        // Buat PDF
        $pdf = PDF::loadView('admin.laporan.cetak', compact('invoices', 'totalGrandTotal', 'start_date', 'end_date', 'product'));

        // Kembalikan file PDF untuk di-download atau ditampilkan
        return $pdf->stream('laporan-penjualan.pdf');
    }
}
