<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">{{__('front.shopping_cart')}}</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Left Section (Cart Items) -->
            <div class="md:w-3/4 w-full">
                <div class="bg-white rounded-lg p-4 sm:p-6 mb-4">
                    <div class="rounded">
                        <div class="flex flex-col">
                            @forelse($cart_items as $item)
                                <div
                                    class="border-b border-[#eff1f5] flex flex-col sm:flex-row items-center py-4 justify-between">
                                    <!-- Product Image and Details -->
                                    <div class="flex items-center justify-between gap-4 px-4 sm:w-auto">
                                        <div class="w-[60px] h-[60px] bg-[#f4f4f4] flex items-center justify-center">
                                            <img src="{{url('storage', $item['image'])}}" alt="{{$item['name']}}"
                                                 class="object-cover rounded w-full h-full">
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <div class="flex flex-col sm:flex-row gap-2 items-center">
                                                <p class="text-lg font-medium text-[#292933]">{{$item['name']}}</p>
                                                @if($item['discount_type'] != null)
                                                    <p class="px-2 py-1 rounded-full bg-yellow-400 font-semibold text-sm sm:text-base text-black">
                                                        {{__('front.discount')}}
                                                        <span>
                                                            {{$item['discount_value']}}
                                                            {{$item['discount_type'] === 'percentage' ? '%' : $currency }}
                                                        </span>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="flex gap-2">
                                                <p class="text-sm text-[#7a818d] font-light">{{__('front.price')}}:</p>
                                                <p class="text-sm text-[#7a818d] font-light">{{Number::currency($item['unit_amount'], $currency)}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls and Total Price -->
                                    <div class="flex flex-col items-end gap-1 px-4 w-full sm:w-auto mt-4 sm:mt-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-lg font-medium text-[#292933]">{{Number::currency($item['total_amount'], $currency)}}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button wire:click="decreaseQty({{$item['product_id']}})"
                                                    class="border rounded-md py-1 px-1">
                                                <x-heroicon-o-minus class="w-5"/>
                                            </button>
                                            <span class="text-center w-5 py-1 px-1">{{$item['quantity']}}</span>
                                            <button wire:click="increaseQty({{$item['product_id']}})"
                                                    class="border rounded-md py-1 px-1">
                                                <x-heroicon-o-plus-small class="w-5"/>
                                            </button>
                                            <button wire:click="removeItem({{$item['product_id']}})"
                                                    class="text-white bg-red-500 px-1 py-1 rounded">
                                                <x-heroicon-o-trash class="w-5"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-2xl sm:text-4xl font-semibold text-slate-500">
                                    {{__('front.no_items_in_the_cart')}}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section (Summary) -->
            <div class="md:w-1/4 w-full">
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                    <h2 class="text-lg font-semibold mb-4">{{__('front.summary')}}</h2>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center text-[#7a818d] justify-between">
                            <p>{{__('front.subTotal')}}</p>
                            <p>{{ Number::currency($grand_total, $currency) }}</p>
                        </div>
                        <div class="flex items-center text-[#7a818d] justify-between">
                            <p>{{__('front.taxes')}}</p>
                            <p>{{Number::currency(0 , $currency)}}</p>
                        </div>
                        <div class="flex items-center text-[#7a818d] justify-between">
                            <p>{{__('front.shipping')}}</p>
                            <p>{{Number::currency(0, $currency)}}</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="flex items-center text-[#292933] font-bold justify-between">
                        <p>{{__('front.total')}}</p>
                        <p>{{Number::currency($grand_total, $currency)}}</p>
                    </div>
                    @if($cart_items)
                        <a href="/checkout"
                           class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg mt-4 w-full">{{__('front.checkout')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
