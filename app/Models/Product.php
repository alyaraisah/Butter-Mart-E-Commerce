<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
            'name',
            'price',
            'description',
            'category_id',
            'image',
            'quantity',
            'status',
            'created_at',
            'updated_at',
        ];
        public function carts()
        {
            return $this->hasMany(Cart::class, 'Product_id', 'id');
        }
}
