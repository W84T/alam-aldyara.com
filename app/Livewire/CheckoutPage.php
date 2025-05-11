<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

#[Title("Checkout")]
class CheckoutPage extends Component
{
    public $cart_items = [];
    public $grand_total;
    public $currency;
    public $exchangeRate;

    public $first_name;
    public $last_name;
    public $phone;
    public $address;
    public $city;
    public $state;
    public $zip_code;

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
//        if(count($cart_items) == 0) {
//            return redirect()->route('/products');
//        }
            // Get currency from cookie
        $this->currency = Cookie::get('currency', 'USD');

        // Cache the exchange rate for 30 minutes
        $this->exchangeRate = Cache::remember("exchange_rate_{$this->currency}", now()->addMinutes(30), function () {
            return CurrencyConverter::convert(1)
                ->from('USD')
                ->to($this->currency)
                ->get();
        });

        // Fetch cart items and convert prices
        $this->cart_items = $this->convertCartPrices(CartManagement::getCartItemsFromCookie());

        // Calculate the grand total directly from the converted cart items
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function placeOrder(){
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();
        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => $this->currency,
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                ],
                'quantity' => $item['quantity'],
            ];
        }
        $order = new Order();
        $order->user_id  = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->status = 'new';
        $order->currency = $this->currency;
        $order->currency_price = $this->exchangeRate;
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';


        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->address = $this->address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;


        $redirect_url = '';
        if ($order->save()) {
            $address->order_id = $order->id;
            $address->save();
            $order->items()->createMany($cart_items);
            CartManagement::clearCartItems();
            $redirect_url = route('success') . '?session_id={CHECKOUT_SESSION_ID}';
            return redirect($redirect_url);
        }
        return redirect($redirect_url);
    }
    public function convertPrice($price)
    {
        return $price * $this->exchangeRate;
    }

    public function convertCartPrices($cartItems)
    {
        return array_map(function ($item) {
            $item['unit_amount'] = $this->convertPrice($item['unit_amount']);
            $item['total_amount'] = $this->convertPrice($item['total_amount']);
            return $item;
        }, $cartItems);
    }
    public function render()
    {
        return view('livewire.checkout-page', [
            'cart_items' => $this->cart_items,
            'grand_total' => $this->grand_total,
            'currency' => $this->currency
        ]);
    }
}
