<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'product_title',
        'quantity',
        'price',
        'image',
        'product_id',
        'payment_status',
        'delivery_status',
    ];
}
