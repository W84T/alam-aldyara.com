<div class="hs-dropdown relative z-[10] inline-flex">
    <button id="hs-dropdown-custom-trigger" type="button"
            class="hs-dropdown-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">

        @if(App::getLocale() === 'ar')
            @flag('sa:1x1', 'w-6 rounded-full', ['id' => 'flag-sa'])
        @else
            @flag('us:1x1', 'w-6 rounded-full', ['id' => 'flag-us'])
        @endif

        <span class="text-gray-600 font-medium truncate max-w-[7.5rem] dark:text-neutral-400">
          @if(App::getLocale() === 'ar')
                {{__("front.ar")}}
            @else
                {{__("front.en")}}
            @endif
        </span>
        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
        </svg>
    </button>

    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700"
         role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-trigger">
        <div class="p-1 space-y-0.5">
            <button wire:click="switchLanguage('ar')"
                    class="flex items-center gap-x-2 w-full py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                @flag('sa:1x1', 'w-6 rounded-full', ['id' => 'flag-sa'])
                {{ __('front.ar') }}
            </button>
            <button wire:click="switchLanguage('en')"
                    class="flex items-center gap-x-2 w-full py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                @flag('us:1x1', 'w-6 rounded-full', ['id' => 'flag-us'])
                {{ __('front.en') }}
            </button>
        </div>
    </div>
</div>
