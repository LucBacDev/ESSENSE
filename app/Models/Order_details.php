<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
    protected $fillable = ['id','order_id', 'pro_id', 'name', 'quantity', 'unit_price', 'size', 'status', 'created_at', 'updated_at'];
}
