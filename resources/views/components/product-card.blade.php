@props(['product', 'currency'])

<div class="swiper-slide !h-[25rem] relative rounded overflow-hidden border">
    <div class="h-2/3">
        <img class="h-full w-full object-cover" src="{{ url('storage', $product->images[0]) }}"
             alt="{{ $product->category->name ?? '' }}">
    </div>
    <div class="py-2 px-3">
        <p class="text-sm text-[#757575] mb-1">
            {{ $product->category->name ?? '' }}
        </p>
        <h3 class="text-xl">
            {{ $product->name }}
        </h3>
        @if($product->discounted_price)
            <h3 class="font-bold">
                <span class="line-through">{{ number_format($product->original_price, 2) }}</span> |
                {{ number_format($product->discounted_price, 2) }}  {{ __('front.'.$currency) }}
            </h3>
        @else
            <h3 class="">
                {{ number_format($product->original_price, 2) }} {{ __('front.'.$currency) }}
            </h3>
        @endif
    </div>
</div>
