<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name','total_amount','status'];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }

}
