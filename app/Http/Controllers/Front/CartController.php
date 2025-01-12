<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Interface\CartInterface;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartUpdateRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct(public CartInterface $cartInterface){}
    public function index()
    {
        $carts = $this->cartInterface;
         return view('front.carts.cart' ,compact('carts'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {

       $validation =   $request->validated();

        $product = Product::findOrFail($request->post('product_id'));

        $this->cartInterface->add($product,$request->post('quantity'));

        return redirect()->route('cart.index');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CartUpdateRequest $request, string $id)
    {
        $validation =   $request->validated();

        // $product = Product::findOrFail($validation['product_id']);

        $this->cartInterface->update($id,$validation['quantity']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cartInterface->delete($id);
    }


}
