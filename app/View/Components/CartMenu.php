<?php

namespace App\View\Components;

use Closure;
use App\Facades\Cart;
use Illuminate\View\Component;
use App\Interface\CartInterface;
use Illuminate\Contracts\View\View;
use App\Repositories\CartRepository;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $items;
    public $total;
    public function __construct()
    {
        /*
          CartRepository $cartRepository
         $this->items = $cartRepository->get();
         $this->total = $cartRepository->total();

        */

        $this->items = Cart::get();
        $this->total = Cart::total();
        /*
        انا ممكن استخدم الطريقه Facades و طريقع اني انادي علي cartRepository علطول
        */
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
