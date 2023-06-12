<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    use HasFactory;
    protected $fillables = ['product_id', 'qty', 'total', 'order_code', 'user_id'];
}
