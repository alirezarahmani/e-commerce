<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = ['product_id' ,'user_id', 'quantity', 'name', 'brand', 'order_id', 'price'];

}
