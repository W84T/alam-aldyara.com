<section class="md:px-24 px-4 md:my-8">

    <div class="flex flex-wrap mb-24 -mx-3">
        <div class="w-full pr-2 lg:w-1/4 hidden lg:block">
            <div class="hs-accordion-group" data-hs-accordion-always-open="">
                <div
                    class="hs-accordion active bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg"
                    id="hs-bordered-heading-one">
                    <button
                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                        aria-expanded="true" aria-controls="hs-basic-bordered-collapse-one">
                        <x-heroicon-o-plus class="hs-accordion-active:hidden block size-3.5"/>
                        <x-heroicon-o-minus class="hs-accordion-active:block hidden size-3.5"/>
                        {{ __("front.category") }}
                    </button>
                    <div id="hs-basic-bordered-collapse-one"
                         class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                         role="region" aria-labelledby="hs-bordered-heading-one">
                        <div class="pb-4 px-5">
                            <ul>
                                @foreach($categories as $category)
                                    <li class="mb-2" wire:key="{{$category->id}}">
                                        <div class="flex">
                                            <input type="checkbox" wire:model.live='selected_categories'
                                                   class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                   id="{{$category->slug}}"
                                                   value="{{$category->id}}">
                                            <label for="{{$category->slug}}"
                                                   class="text-base text-gray-500 ms-3">{{$category->name}}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="hs-accordion active bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg"
                    id="hs-bordered-heading-two">
                    <button
                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                        aria-expanded="true" aria-controls="hs-basic-bordered-collapse-two">
                        <x-heroicon-o-plus class="hs-accordion-active:hidden block size-3.5"/>
                        <x-heroicon-o-minus class="hs-accordion-active:block hidden size-3.5"/>
                        {{ __("front.category") }}
                    </button>
                    <div id="hs-basic-bordered-collapse-two"
                         class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                         role="region" aria-labelledby="hs-bordered-heading-two">
                        <div class="pb-4 px-5">
                            <ul>
                                @foreach($categories as $category)
                                    <li class="mb-2" wire:key="{{$category->id}}">
                                        <div class="flex">
                                            <input type="checkbox" wire:model.live='selected_categories'
                                                   class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                   id="{{$category->slug}}"
                                                   value="{{$category->id}}">
                                            <label for="{{$category->slug}}"
                                                   class="text-base text-gray-500 ms-3">{{$category->name}}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="w-full px-3 lg:w-3/4">
            <div class="mb-4">
                <div
                    class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex">
                    <div class="flex items-center justify-between">
                        <select wire:model.live="sort"
                                class="block w-40 text-base bg-gray-100 cursor-pointer">
                            <option value="latest">Sort by latest</option>
                            <option value="price">Sort by Price</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center ">
                <div class="grid md:grid-cols-4 grid-cols-2 w-full gap-4">
                    @foreach($products as $product)
                        <div wire:key="{{$product->id}}">
                            <x-product-card :product="$product" :currency="$currency"/>
                        </div>
                    @endforeach
                </div>

            </div>
            <!-- pagination start -->
            <div class="flex justify-end mt-6">
                {{$products->links()    }}
            </div>
            <!-- pagination end -->
        </div>
    </div>

</section>
