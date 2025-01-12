<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Interface\CartInterface;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(public CartInterface $cartInterface){}
    public function index()
    {
        $products = Product::active()->latest()->take(8)->get();
        return view('front.home' ,compact('products'));
    }
        public function cart()
        {
            $carts = $this->cartInterface;
             return view('front.layouts.front_app' ,compact('carts'));
        }
}
