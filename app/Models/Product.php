<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image', 'title', 'slug', 'category_id', 'content', 'weight', 'price', 'discount', 'stock', 'status', 'bahan'
    ];

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/products/' . $value),
        );
    }

     /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * carts
     *
     * @return void
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * orders
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}