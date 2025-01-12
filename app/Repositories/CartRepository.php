<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Interface\CartInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartRepository implements CartInterface
{

    public $item ;

    public function __construct()
    {
        $this->item = collect([]);
    }

    public function get(){
        if(!$this->item->count())
        {
            $this->item = Cart::with('product')->get();
        }
        return $this->item;

    }
    public function add(Product $product , $quantity=1){

        $item = Cart::where('product_id','=',$product->id)
        ->first();
        if(!$item)
        {
            $cart =  Cart::create([
                'user_id' => Auth::user(),
                'product_id'=> $product->id,
                'quantity'=> $quantity
            ]);
            $this->get()->push($cart);
            return $cart ;
        }

        return $item->increment('quantity', $quantity);

    }
    public function update($id , $quantity){
         Cart::where('id',$id)->update([
            'quantity'=> $quantity
        ]);
    }
    public function delete($id){
        Cart::where('id','=',$id)->delete();
    }
    public function empty(){
        Cart::query()->delete();

    }
    public function total(){
        // return  Cart::join('products','products.id','=','carts.product_id')
        // ->selectRaw('SUM(products.price * carts.quantity) as total')
        // ->value('total');

        return $this->get()->sum(function($val){
            return $val->quantity *  $val->product->price;
        });
    }
}
