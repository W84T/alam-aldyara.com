<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <form wire:submit.prevent='placeOrder'>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Card -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            {{__('front.shipping_address')}}
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    {{__('form.first_name')}}
                                </label>
                                <input
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    wire:model='first_name' id="first_name" type="text">
                                @error('first_name')
                                <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    {{__('form.last_name')}}
                                </label>
                                <input wire:model='last_name'
                                       class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                       id="last_name" type="text">
                                @error('last_name')
                                <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                {{__('form.phone')}}
                            </label>
                            <input wire:model="phone"
                                   class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                   id="phone" type="text">
                            @error('phone')
                            <div class="text-red-500 text-sm">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                {{__('form.address')}}
                            </label>
                            <input wire:model="address"
                                   class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                   id="address" type="text">
                            @error('address')
                            <div class="text-red-500 text-sm">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="city">
                                {{__('form.city')}}
                            </label>
                            <input wrie:model="city"
                                   class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                   id="city" type="text">
                            @error('city')
                            <div class="text-red-500 text-sm">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="state">
                                    {{__('form.state')}}
                                </label>
                                <input wire:model="state"
                                       class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                       id="state" type="text">
                                @error('state')
                                <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                                    {{__('form.zip_code')}}
                                </label>
                                <input wire:model="zip_code"
                                       class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                       id="zip" type="text">
                                @error('zip_code')
                                <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        {{__('front.summary')}}
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
					<span>
						 {{__('front.subTotal')}}
					</span>
                        <span>
						{{ Number::currency($grand_total, $currency) }}
					</span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
					<span>
						{{__('front.taxes')}}
					</span>
                        <span>
						{{Number::currency(0 , $currency)}}
					</span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
					<span>
						{{__('front.shipping')}}
					</span>
                        <span>
						{{Number::currency(0, $currency)}}
					</span>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold">
					<span>
						{{__('front.total')}}
					</span>
                        <span>
						{{Number::currency($grand_total, $currency)}}
					</span>
                    </div>
                    </hr>
                </div>
                <button type="submit"
                        class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                    Place Order
                </button>
                <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        {{__('front.basket_summary')}}
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach($cart_items as $cart_item)
                            <li class="py-3 sm:py-4" wire:key="{{$cart_item['product_id']}}">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="{{$cart_item['name']}}" class="w-12 h-12 rounded-full"
                                             src="{{url('storage', $cart_item['image'])}}">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{$cart_item['name']}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{__('front.quantity')}}: {{$cart_item['quantity']}}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{Number::currency($cart_item['total_amount'], $currency)}}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
