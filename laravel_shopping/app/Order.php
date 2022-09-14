<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $filable = ['total', 'order_date', 'order_number', 'customer_address', 'customer_email', 'customer_name', 'customer_phone', 'user_id', 'status'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'product_id', 'order_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
