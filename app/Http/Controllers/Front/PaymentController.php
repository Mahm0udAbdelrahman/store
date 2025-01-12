<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create',compact('order'));
    }

    public function createStripPaymentIntent(Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.strip.secret_key'));
        $amount = $order->items->sum(function($item){
           return $item->price * $item->quantity;
        });
        $paymentIntent = $stripe->paymentIntents->create([
          'amount' => $amount,
          'currency' => 'usd',
          'automatic_payment_methods' => ['enabled' => true],
        ]);
            return [
                'clientSecret' => $paymentIntent->client_secret,
            ];


    }


    public function confirm(Request $request,Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.strip.secret_key'));

        $stripe->paymentIntents->retrieve($request->query('payment_intent'), []);

    }
}
