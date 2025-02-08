<?php

namespace App\Livewire;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class HomePage extends Component
{
    public $currency;

    public function mount()
    {
        // Get saved currency from session or default to USD
        $this->currency = Session::get('currency', 'USD');
    }

    public function render()
    {
        // Fetch all required products with relationships
        $products = Product::where('is_featured', 1)
            ->where('is_active', 1)
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })
            ->with(['category', 'discounts' => function ($query) {
                $query->wherePivot('is_active', 1); // Only active discounts
            }])
            ->get()
            ->map(function ($product) {
                // Convert price to selected currency
                $originalPrice = CurrencyConverter::convert($product->price)
                    ->from('USD')
                    ->to($this->currency)
                    ->get();

                // Default value for discounted price
                $discountedPrice = null;

                // Check if there's an active discount
                $discount = $product->discounts->first();
                if ($discount) {
                    if ($discount->discount_type === 'fixed') {
                        $discountedPrice = $product->price - $discount->value;
                    } elseif ($discount->discount_type === 'percentage') {
                        $discountAmount = ($discount->value / 100) * $product->price;
                        $discountedPrice = $product->price - $discountAmount;
                    }

                    // Convert discounted price
                    if ($discountedPrice !== null) {
                        $discountedPrice = CurrencyConverter::convert($discountedPrice)
                            ->from('USD')
                            ->to($this->currency)
                            ->get();
                    }
                }

                // Add calculated prices to product object
                $product->original_price = $originalPrice;
                $product->discounted_price = $discountedPrice;

                return $product;
            });

        // Filter discounted products from the already fetched collection
        $discountProducts = $products->filter(fn($product) => $product->discounted_price !== null);

        // Fetch categories and banners
        $categories = Category::where('is_active', 1)->get();
        $banners = Banner::where('is_active', 1)->get();

        return view('livewire.home-page', [
            'categories' => $categories,
            'banners' => $banners,
            'products' => $products,
            'discountProducts' => $discountProducts, // Pass only discounted products
        ]);
    }


}
