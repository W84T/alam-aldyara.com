<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-3 dark:bg-neutral-800">
    <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
        <a class="sm:order-1 flex-none text-xl font-semibold dark:text-white focus:outline-none focus:opacity-80"
           href="#">
            <span class="inline-flex items-center gap-x-2 text-xl font-semibold dark:text-white">
          <img class="w-10 h-auto" src="{{url('storage', 'logo.png')}}" alt="Logo">
        </span>
        </a>
        <div class="sm:order-3 flex items-center gap-x-2">
            <div class="hidden  lg:flex lg:items-center lg:gap-2">
                <a href="/" class="relative">
                    <div
                        class="absolute -start-1 h-3 w-3 text-white font-bold flex items-center justify-center -bottom-1 bg-blue-500 rounded-full">

                    </div>
                    <x-heroicon-o-shopping-bag class="w-6 h-6"/>
                </a>

            </div>

            <button type="button"
                    class="sm:hidden hs-collapse-toggle relative py-2 px-3 flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
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
