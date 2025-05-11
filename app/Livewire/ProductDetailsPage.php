<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partial\Navbar;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductDetailsPage extends Component
{
    use LivewireAlert;

    public $slug;
    public $currency;
    public $exchangeRate;
    public $product;
    public $quantity = 1;

    public function addToCart($productID){
        $total_count = CartManagement::addItemsToCart($productID, $this->quantity);

        $this->dispatch('products_in_cart', have_cart_items: $total_count > 0)->to(Navbar::class);

        $this->alert('success', __('front.added_to_cart'), [[
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
        ]]);
    }

    public function increaseQty(){
        $this->quantity++;
    }
    public function decreaseQty(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    public function mount($slug)
    {
        $this->currency = Cookie::get('currency', 'USD');

        // Cache the exchange rate for 30 minutes
        $this->exchangeRate = Cache::remember("exchange_rate_{$this->currency}", now()->addMinutes(30), function () {
            return CurrencyConverter::convert(1)
                ->from('USD')
                ->to($this->currency)
                ->get();
        });

        $this->slug = $slug;
        $this->loadProduct();
    }

    public function loadProduct()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail();

        // Convert original price
        $originalPrice = $product->price * $this->exchangeRate;

        // Calculate discounted price
        $discountedPrice = null;
        if ($discount = $product->discounts->first()) {
            $discountedPrice = match ($discount->discount_type) {
                'fixed' => max(0, $product->price - $discount->value),
                'percentage' => max(0, $product->price - ($discount->value / 100) * $product->price),
                default => null
            };

            // Convert discounted price
            if ($discountedPrice !== null) {
                $discountedPrice *= $this->exchangeRate;
            }
        }

        // Round prices
        $product->original_price = round($originalPrice, 2);
        $product->discounted_price = $discountedPrice !== null ? round($discountedPrice, 2) : null;

        $this->product = $product;
    }

    public function render()
    {
        $this->loadProduct();
        return view('livewire.product-details-page', [
            'product' => $this->product
        ]);
    }
}
