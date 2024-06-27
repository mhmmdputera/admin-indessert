<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'invoice', 'customer_id', 'cost_ongkir', 'weight', 'name', 'phone', 'kabupaten', 'kecamatan', 'address', 'status', 'snap_token', 'grand_total', 'order_received'
    ];

    /**
     * order
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * customer
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(Riwayat::class);
    }
}