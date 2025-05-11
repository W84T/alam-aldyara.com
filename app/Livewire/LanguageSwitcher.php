<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = Session::get('locale', App::getLocale());
    }

    public function switchLanguage($lang)
    {
        App::setLocale($lang);
        Session::put('locale', $lang);
        $this->locale = $lang;
        return redirect(request()->header('Referer') ?? route('home'));
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
