<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CurrencySwitcher extends Component
{
  public $currency;
  public function mount(){
      $this->currency = Cookie::get('currency', 'USD');
  }

  public function switchCurrency($curr){
      Cookie::queue('currency', $curr, 525600);
      $this->currency = $curr;

      return redirect(request()->header('Referer') ?? route('home'));
  }

    public function render()
    {
        return view('livewire.currency-switcher');
    }
}
