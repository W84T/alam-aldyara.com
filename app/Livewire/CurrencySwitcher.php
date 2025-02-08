<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CurrencySwitcher extends Component
{
  public $currency;
  public function mount(){
      $this->currency = Session::get('currency', 'USD');
  }

  public function switchCurrency($curr){
      Session::put('currency', $curr);
      $this->currency = $curr;

      return redirect(request()->header('Referer') ?? route('home'));
  }

    public function render()
    {
        return view('livewire.currency-switcher');
    }
}
