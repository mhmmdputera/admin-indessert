<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Customer;

class RiwayatController extends Controller
{

    public function index()
    {

        $customers = Customer::with(['invoices' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->latest()->when(request()->q, function($customers) {
            $customers = $customers->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        
        return view('admin.riwayat.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id); // Asumsi model User digunakan untuk pelanggan
        $invoices = Invoice::with(['orders', 'statusHistories'])
            ->where('customer_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.riwayat.show', compact('customer', 'invoices'));
    }
}
