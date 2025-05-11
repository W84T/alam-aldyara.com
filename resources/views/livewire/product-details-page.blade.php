<div class="w-full  px-4 md:px-24 md:my-8">

    <div class=" px-4  mx-auto md:px-6">
        <div class="flex flex-wrap -mx-4">
            <!-- Product Images Section -->
            <div class="w-full mb-8 md:w-3/5 md:mb-0"
                 x-data="{ mainImage: '{{ url('storage', $product->images[0]) }}' }">

                <!-- Swiper for Mobile -->
                <div class="block md:hidden">
                    <div class="swiper swiper-product-preview">
                        <div class="swiper-wrapper">
                            @foreach($product->images as $image)
                                <div class="swiper-slide !h-[30rem]  rounded-lg overflow-hidden">
                                    <div class="h-full w-full">
                                        <img src="{{ url('storage', $image) }}"
                                             class="object-cover">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Swiper Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Thumbnails for Desktop -->
                <div class="hidden md:grid md:grid-cols-6 gap-4 items-start">

                    <!-- Thumbnails (1/6 of the width) -->
                    <div class="col-span-1 flex flex-col gap-2">
                        @foreach($product->images as $image)
                            <div class="cursor-pointer p-1" x-on:click="mainImage='{{ url('storage', $image) }}'">
                                <img src="{{ url('storage', $image) }}"
                                     alt="Thumbnail"
                                     class="object-cover w-full h-20 rounded-md border border-gray-300 hover:border-blue-500">
                            </div>
                        @endforeach
                    </div>

                    <!-- Main Image (5/6 of the width) -->
                    <div class="col-span-5">
                        <img x-bind:src="mainImage"
                             alt="Product Image"
                             class="object-cover w-full h-[32rem] rounded-lg">
                    </div>

                </div>


            </div>

            <!-- Product Details -->
            <div class="w-full px-4 md:w-2/5">
                <div class="">
                    <h2 class="text-2xl font-bold md:text-4xl">
                        {{ $product->name }}</h2>
                    @if($product->discounted_price)
                        <h3 class="font-bold mt-2 text-sm">
                            {{--                {{ number_format($product->discounted_price, 2) }}  {{ __('front.'.$currency) }}--}}
                            {{App::getLocale()  == 'en' ? Number::currency($product->discounted_price, $currency): number_format($product->discounted_price, 2) .' '. __('front.'.$currency)}}

                            | <span
                                class="line-through font-light text-[#333]">{{ number_format($product->original_price, 2) }}</span>
                        </h3>
                    @else
                        <h3 class="font-bold mt-2 text-sm">
                            {{App::getLocale()  == 'en' ? Number::currency($product->original_price, $currency): number_format($product->original_price, 2) .' '. __('front.'.$currency)}}
                        </h3>
                    @endif
                    <p class="text-gray-500 mt-2">
                        {{--                        {!! Str::markdown($product->description) !!}---}}
                        {!! nl2br(Str::markdown($product->description)) !!}

                    </p>
                    <div class="flex gap-2">

                        <button wire:click.prevent="addToCart({{$product->id}})"
                                class="w-full p-4 bg-black rounded-md lg:w-2/5  text-gray-50 hover:bg-blue-600">
                            {{__('front.add_to_cart')}}
                        </button>


                        <div class="py-2 px-3 inline-block bg-white border border-gray-200 rounded-lg"
                             data-hs-input-number="">
                            <div class="flex items-center gap-x-1.5">
                                <button wire:click="decreaseQty"
                                        type="button"
                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                        tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                    <x-heroicon-m-minus-small/>

                                </button>
                                <input
                                    wire:model="quantity"
                                    class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                    style="-moz-appearance: textfield;" type="number"
                                    aria-roledescription="Number field"
                                    value="0" data-hs-input-number-input="">
                                <button wire:click="increaseQty"
                                        type="button"
                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                        tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                    <x-heroicon-c-plus/>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
