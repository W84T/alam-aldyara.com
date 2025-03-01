<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-3">
    <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
        <a class="sm:order-1 flex-none text-xl font-semibold focus:outline-none focus:opacity-80"
           href="#">
            <span class="inline-flex items-center gap-x-2 text-xl font-semibold">
          <img class="w-10 h-auto" src="{{url('storage', 'logo.png')}}" alt="Logo">
        </span>
        </a>
        <div class="sm:order-3 flex items-center gap-x-2">
            <div class="hidden  lg:flex lg:items-center lg:gap-2">
                <a href="/cart" wire:navigate class="relative">
                    @if($have_cart_items)
                        <div
                            class="absolute -start-1 h-3 w-3 text-white font-bold flex items-center justify-center -bottom-1 bg-blue-500 rounded-full"></div>
                    @endif
                    <x-heroicon-o-shopping-bag class="w-6 h-6"/>
                </a>
            </div>

            @auth()
                <div class="hs-dropdown relative z-[10] inline-flex">
                    <button id="hs-dropdown-custom-trigger" type="button"
                            class="hs-dropdown-toggle py-1 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-full bg-white text-gray-800 disabled:opacity-50 disabled:pointer-events-none"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <span
                            class="text-gray-600 font-medium truncate">{{auth()->user()->name}}</span>
                        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-trigger">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                               href="/logout">
                                <x-heroicon-o-arrow-left-end-on-rectangle class="w-5 h-5"/>
                                {{__('front.logout')}}
                            </a>
                        </div>
                    </div>
                </div>
            @endauth

            @guest()
                <a href="/login"
                   class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    {{__('front.login')}}
                </a>
            @endguest
            <button type="button"
                    class="sm:hidden hs-collapse-toggle relative py-2 px-3 flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                    id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">

                <x-heroicon-s-equals class="hs-collapse-open:hidden shrink-0 size-5"/>

                <x-heroicon-s-x-mark class="hs-collapse-open:block hidden shrink-0 size-5"/>

                </svg>
                <span class="sr-only">Toggle</span>
            </button>

        </div>
        <div id="hs-navbar-alignment"
             class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2"
             aria-labelledby="hs-navbar-alignment-collapse">
            <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
                <a class="font-medium focus:outline-none {{request()->is('/') ? 'text-blue-500' : 'text-gray-600'}}  hover:text-gray-400"
                   href="{{ route('home') }}" wire:navigate>{{ __('front.home') }}</a>
                <a class="font-medium focus:outline-none {{request()->is('products') ? 'text-blue-500' : 'text-gray-600'}}  hover:text-gray-400"
                   href="{{ route('products') }}" wire:navigate>{{ __('front.products') }}</a>
                <div class="flex md:hidden sm:block gap-3">
                </div>
            </div>
        </div>

    </nav>
</header>
