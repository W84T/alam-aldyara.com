<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-3 dark:bg-neutral-800">
    <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
        <a class="sm:order-1 flex-none text-xl font-semibold dark:text-white focus:outline-none focus:opacity-80"
           href="#">
            <span class="inline-flex items-center gap-x-2 text-xl font-semibold dark:text-white">
          <img class="w-10 h-auto" src="{{url('storage', 'logo.png')}}" alt="Logo">
        </span>
        </a>
        <div class="sm:order-3 flex items-center gap-x-2">
            <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                Button
            </button>

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
                <x-nav-link href="{{ route('home') }}">{{ __('front.home') }}</x-nav-link>
                <x-nav-link href="{{ route('products') }}">{{ __('front.products') }}</x-nav-link>
            </div>
        </div>

    </nav>
</header>
