<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table = 'order_items';

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id')->withDefault([
            'name' => $this->product_name
        ]);
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }



}
