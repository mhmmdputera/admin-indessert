<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Riwayat;
use App\Models\Telegram;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $invoices = Invoice::where('customer_id', auth()->guard('api')->user()->id)->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Invoices: '.auth()->guard('api')->user()->name,
            'data'    => $invoices  
        ], 200);

    }
    
    /**
     * show
     *
     * @param  mixed $snap_token
     * @return void
     */
    public function show($snap_token)
    {
        $invoice = Invoice::where('customer_id', auth()->guard('api')->user()->id)->where('snap_token', $snap_token)->latest()->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail Invoices: '.auth()->guard('api')->user()->name,
            'data'    => $invoice, 
            'product' => $invoice->orders 
        ], 200);

    }

    /**
     * updateStatus
     *
     * @param  Request $request
     * @param  mixed $id
     * @return void
     */
    public function updateStatus(Request $request, $id)
    {
        $invoice = Invoice::with('orders')->findOrFail($id);

        if ($invoice->status == 'success') {
            return response()->json(['message' => 'Order already marked as success'], 400);
        }

        $invoice->status = 'success';
        $invoice->save();

        // Simpan riwayat status
        Riwayat::create([
            'invoice_id' => $invoice->id,
            'status' => 'success',
            'created_at' => now(),
        ]);

        // Reduce product stock
        foreach ($invoice->orders as $order) {
            $product = Product::find($order->product_id);
            if ($product) {
                $product->stock -= $order->qty;
                $product->save();
            }
        }

        // Kirim notifikasi Telegram
        $this->sendTelegramNotification($invoice);

        return response()->json(['message' => 'Order status updated to success and product stock reduced.']);
    }

    /**
     * confirmOrderReceived
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmOrderReceived($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->order_received = true;
        $invoice->save();

        return response()->json(['message' => 'Order has been confirmed as received.']);
    }

    // Method to cancel the order
    public function cancelOrder($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'failed';
        $invoice->save();

        // Simpan riwayat status
        Riwayat::create([
            'invoice_id' => $invoice->id,
            'status' => 'failed',
            'created_at' => now(),
        ]);

        return response()->json(['message' => 'Order has been canceled successfully.']);
    }

    /**
     * sendTelegramNotification
     *
     * @param  mixed $invoice
     * @return void
     */
    protected function sendTelegramNotification($invoice)
    {
        $telegram = Telegram::first(); // Asumsikan hanya ada satu data di tabel Telegrams

        if ($telegram) {
            $token = $telegram->token;
            $chatId = $telegram->id_chat;
            $message = "📢 Pembayaran Pre-Order Berhasil! 📢\n\nPesanan ID: {$invoice->id} telah berhasil diproses.\n\n👤 Pelanggan: {$invoice->customer->name}\n📞 Telepon: {$invoice->phone}\n📦 Produk: {$invoice->orders->pluck('product.title')->join(', ')}\n\nSegera proses pesanan ini.";

            $url = "https://api.telegram.org/bot{$token}/sendMessage";

            Http::post($url, [
                'chat_id' => $chatId,
                'text' => $message
            ]);
        }
    }

    /**
     * Export PDF
     *
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function exportPdf($snap_token)
    {
        $invoice = Invoice::where('customer_id', auth()->guard('api')->user()->id)->where('snap_token', $snap_token)->latest()->first();

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        $products = $invoice->orders;

        $pdf = Pdf::loadView('admin.order.cetak', compact('invoice', 'products'));
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }

}