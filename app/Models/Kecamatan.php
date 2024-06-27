<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'kabupaten_id', 'title', 'ongkir'
    ];

    /**
     * kabupatens
     *
     * @return void
     */
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
