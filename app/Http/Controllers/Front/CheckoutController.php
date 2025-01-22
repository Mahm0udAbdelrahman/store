<?php

namespace App\Http\Controllers\Front;

use Throwable;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Notifications\OrderCreatedNotification;

class CheckoutController extends Controller
{

    public function __construct(public CartRepository $cartRepository){}
    public function create()
    {
        User::find(1)->notify(new OrderCreatedNotification(new Order()));
        return;
        if($this->cartRepository->get()->count() == 0)
        {
            return redirect()->route('home');
        }
        $cart = $this->cartRepository;
        $countries = Countries::getNames();
        return view('front.checkout.create', compact('cart', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'addr.billing.first_name' => ['required','string','max:255'],
            'addr.billing.last_name' => ['required','string','max:255'],
            'addr.billing.email' => ['required','string','max:255'],
            'addr.billing.phone_number' => ['required','string','max:255'],
            'addr.billing.city' => ['required','string','max:255'],
        ]);
        $items = $this->cartRepository->get()->groupBy('product.store_id')->all();
        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);
                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }

            }
            $this->cartRepository->empty();
            DB::commit();
            // event(new OrderCreated($order));
        } catch (Throwable $e) {
            DB::rollBack();
            return $e;

        }

        return redirect()->route('orders.payments.create',$order->id);

    }

}
