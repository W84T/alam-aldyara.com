<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    public string $href;

    public function __construct(string $href)
    {
        $this->href = $href;
    }

    public function isActive(): bool
    {
        return request()->is(ltrim(parse_url($this->href, PHP_URL_PATH), '/'));
    }

    public function render()
    {
        return view('components.nav-link');
    }
}
