<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id',
        'user_id',
        'number',
        'payment_method',
        'status',
        'payment_status'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id','id','id')
        ->using(OrderItem::class)
        ->withPivot([
            'options' ,'quantity' ,'price' ,'product_name',
        ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');

    }
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class,'order_id','id');
    }
    public function billingAddress()
    {
        // return $this->addresses()->where('type','=','billing'); //return collection

        return $this->hasOne(OrderAddress::class,'order_id','id')
        ->where('type','=','billing'); // return model
    }
    public function shippingAddress()
    {
        return $this->hasMany(OrderAddress::class,'order_id','id')
        ->where('type','=','shipping');
    }

    protected static function booted()
    {
        static::creating(function(Order $order){
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        if($number)
        {
            return $number +1 ;
        }

        return $year + '0001';
    }
}
