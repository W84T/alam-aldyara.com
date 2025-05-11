<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class ProductsPage extends Component
{
    use WithPagination;

    #[Url(as: 'selected_categories', keep: false)]
    public $selected_categories = [];
    public $featured;
    public $on_sale;
    public $price_range;
    public $sort = 'latest';
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

        $selected = request()->query('selected_categories', []);

        // Ensure it's always an array
        if (!is_array($selected)) {
            $selected = [$selected];
        }

        $this->selected_categories = $selected;
    }
    public function render()
    {
        // Start building the query
        $productsQuery = Product::select('id', 'name', 'slug', 'price', 'category_id', 'images','is_featured', 'is_active')
            ->where('is_active', 1)
            ->with(['category' => function ($query) {
                $query->select('id', 'name', 'slug');
            }, 'discounts' => function ($query) {
                $query->wherePivot('is_active', 1); // Only active discounts
            }]);

        // Apply filters
        if (!empty($this->selected_categories)) {
            $productsQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->featured)) {
            $productsQuery->where('is_featured', 1);
        }


        if($this->sort === 'latest'){
            $productsQuery->latest();
        }
        if($this->sort === 'price'){
            $productsQuery->orderBy('price');
        }

        // Fetch products with relationships and apply pagination
        $products = $productsQuery->paginate(12);

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

        return view('livewire.products-page', [
            'products' => $products,
            'currency' => $this->currency,
            'categories' => Category::where('is_active', 1)->where('parent_id', Null)->get(['id', 'name', 'slug']),
        ]);
    }
}
