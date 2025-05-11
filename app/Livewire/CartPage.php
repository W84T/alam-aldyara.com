<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partial\Navbar;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;
use Livewire\Component;

class CartPage extends Component
{
    public $cart_items = [];
    public $grand_total;
    public $currency;
    public $exchangeRate;

    public function mount()
    {
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

    public function removeItem($product_id)
    {
        $this->cart_items = $this->convertCartPrices(CartManagement::removeCartItem($product_id));
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('products_in_cart', have_cart_items: count($this->cart_items) > 0)->to(Navbar::class);
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = $this->convertCartPrices(CartManagement::incrementQuantityToCartItem($product_id));
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = $this->convertCartPrices(CartManagement::decrementQuantityToCartItem($product_id));
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {

        return view('livewire.cart-page', [
            'cart_items' => $this->cart_items,
            'grand_total' => $this->grand_total,
            'currency' => $this->currency
        ]);
    }
}
