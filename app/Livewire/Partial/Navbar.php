<?php

namespace App\Livewire\Partial;

use App\Helpers\CartManagement;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;

    public function mount(){
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }
    public function render()
    {
        return view('livewire.partial.navbar');
    }
}
