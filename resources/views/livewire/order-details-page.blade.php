<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">{{__('panel.order_details')}}</h1>

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('form.name')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <div>{{$address->full_name}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 22h14"/>
                        <path d="M5 2h14"/>
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/>
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/>
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('front.date')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                            {{$order->created_at->format('d-m-y')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6"/>
                        <path d="m12 12 4 10 1.7-4.3L22 16Z"/>
                    </svg>
                </div>

                @php
                    $status = '';
                    if($order->status == 'new')
                        $status = 'bg-blue-500';
                    elseif($order->status == 'processing' || $order->status == 'shipping')
                        $status = 'bg-yellow-500';
                    elseif($order->status == 'delivered')
                        $status = 'bg-green-500';
                    elseif($order->status == 'cancelled')
                        $status = 'bg-red-500';
                @endphp

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('form.status')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <span
                            class="{{$status}} py-1 px-3 rounded text-white shadow">{{__('status.'.$order->status)}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

    </div>
    <!-- End Grid -->

    <div class="flex flex-col md:flex-row gap-4 mt-4">
        <div class="md:w-3/4">
            <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="text-start font-semibold">{{__('form.product_name')}}</th>
                        <th class="text-start font-semibold">{{__('front.price')}}</th>
                        <th class="text-start font-semibold">{{__('front.quantity')}}</th>
                        <th class="text-start font-semibold">{{__('front.total')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_items as $item)
                        <tr wire:key="{{$item->id}}">
                            <td class="py-4">
                                <div class="flex items-center">
                                    <img class="h-16 w-16 me-4 rounded"
                                         src="{{url('storage', $item->product->images[0])}}"
                                         alt="{{$item->product->name}}">
                                    <span class="font-semibold">{{$item->product->name}}</span>
                                </div>
                            </td>
                            <td class="py-4">{{Number::currency($item->unit_amount, $order->currency)}}</td>
                            <td class="py-4">
                                <span class="text-center w-8">{{$item->quantity}}</span>
                            </td>
                            <td class="py-4">{{Number::currency($item->total_amount, $order->currency)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <h1 class="font-3xl font-bold text-slate-500 mb-3">{{__('front.shipping_address')}}</h1>
                <div class="flex justify-between items-center">
                    <div>
                        <p>{{$address->zip_code}}, {{$address->city}}, {{$address->address}}</p>
                    </div>
                    <div>
                        <p class="font-semibold">{{__('form.phone')}}</p>
                        <p>{{$address->phone}}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4"> {{__('front.summary')}}</h2>
                <div class="flex justify-between mb-2">
                    <span>{{__('front.subTotal')}}</span>
                    <span>{{ Number::currency($item->order->grand_total, $item->order->currency) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>{{__('front.taxes')}}</span>
                    <span>{{Number::currency(0 , $item->order->currency)}}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>{{__('front.shipping')}}</span>
                    <span>{{Number::currency(0 , $item->order->currency)}}</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-bold">{{__('front.total')}}</span>
                    <span
                        class="font-bold">{{ Number::currency($item->order->grand_total, $item->order->currency) }}</span>
                </div>

            </div>
        </div>
    </div>
</div>
