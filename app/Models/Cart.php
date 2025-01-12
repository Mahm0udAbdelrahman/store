<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
 use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public $incrementing = false;
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'option'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    protected static function booted(){
        static::observe(CartObserver::class);
        static::addGlobalScope(function(Builder $builder){
            $builder->where('cookie_id','=',static::getCookieId());
        });
    }

    public static function getCookieId()
    {
        $cookie = Cookie::get('cart_id');
        if(!$cookie)
        {
            $cookie = Str::uuid();
            Cookie::queue('cart_id',$cookie , 30* 24 *60);
        }
        return $cookie;
    }

}
