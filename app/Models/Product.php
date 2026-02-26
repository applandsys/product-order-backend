<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','sku','price','stock_quantity'];

    public function ordersItems(){
        return $this->hasMany(Order::class);
    }
}

