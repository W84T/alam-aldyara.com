<?php

namespace App\Livewire;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class HomePage extends Component
{
    public $currency;
    public $exchangeRate;

    public function mount()
    {
        // Get saved currency from session or default to USD
        $this->currency = Cookie::get('currency', 'USD');

        // Cache the conversion rate for 30 minutes to reduce API calls
        $this->exchangeRate = Cache::remember("exchange_rate_{$this->currency}", now()->addMinutes(30), function () {
            return CurrencyConverter::convert(1)
                ->from('USD')
                ->to($this->currency)
                ->get();
        });
    }

    public function render()
    {
        // Fetch featured products directly from the database
        $products = Product::where('is_featured', 1)
            ->where('is_active', 1)
            ->with(['discounts' => function ($query) {
                $query->wherePivot('is_active', 1);
            }])
            ->take(10)
            ->get();

        // Convert product prices using the exchange rate
        $products->transform(function ($product) {
            // Convert original price
            $originalPrice = $product->price * $this->exchangeRate;

            // Calculate discounted price if applicable
            $discountedPrice = null;
            if ($discount = $product->discounts->first()) {
                $discountedPrice = match ($discount->discount_type) {
                    'fixed' => ($product->price - $discount->value),
                    'percentage' => ($product->price - ($discount->value / 100) * $product->price),
                    default => null
                };

                // Convert discounted price
                if ($discountedPrice !== null) {
                    $discountedPrice *= $this->exchangeRate;
                }
            }

            // Round prices for cleaner display
            $product->original_price = round($originalPrice, 2);
            $product->discounted_price = $discountedPrice !== null ? round($discountedPrice, 2) : null;

            return $product;
        });

        // Filter only discounted products
        $discountProducts = $products->filter(fn($product) => $product->discounted_price !== null);

        // Fetch categories and banners directly from the database
        $categories = Category::where('is_active', 1)->where('parent_id', null)->take(10)->get();
        $banners = Banner::where('is_active', 1)->get();

        return view('livewire.home-page', [
            'categories' => $categories,
            'banners' => $banners,
            'products' => $products,
            'discountProducts' => $discountProducts,
        ]);
    }
}
