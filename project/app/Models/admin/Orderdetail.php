<?php

namespace App\Models\admin;

use App\Models\clients\Ordered;
use App\Models\clients\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Orderdetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetail';
    public function product()
    {
        return $this->belongsTo(Products::class, 'ProductID');
    }

    // Quan hệ với OrderProduct
    public function orderProduct()
    {
        return $this->belongsTo(Ordered::class, 'OrderID');
    }
}
