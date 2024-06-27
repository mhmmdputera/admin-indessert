<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
         'name'
    ];

     /**
     * kecamatans
     *
     * @return void
     */
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }

   
}