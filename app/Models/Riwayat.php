<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'status', 'created_at'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
