<?php

namespace App\Livewire;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $banners = Banner::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $featuredProducts = Product::where('is_active', 1)->whereHas('category', function($query){
            $query->where('is_active', 1);
        })->get();
        return view('livewire.home-page',
        [
            'banners' => $banners,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts
        ]);
    }
}
