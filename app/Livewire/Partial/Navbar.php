<?php

namespace App\Livewire\Partial;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $have_cart_items = false;

    public function mount(){
        $this->have_cart_items = count(CartManagement::getCartItemsFromCookie()) > 0;
    }

    #[On('products_in_cart')]
    public function productsInCart($have_cart_items){
        $this->have_cart_items = $have_cart_items;
    }
    public function render()
    {
        return view('livewire.partial.navbar');
    }
}
