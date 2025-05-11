@props(['product', 'currency'])

<div class="swiper-slide !h-[22rem] relative rounded overflow-hidden">
    <div class="h-4/5">
        <a href="/products/{{$product->slug}}" class="">
            <img class="h-full aspect-video w-full object-cover"
                 src="{{ url('storage', $product->images[0] ?? 'default-image.jpg') }}"
                 alt="{{ $product->category->name ?? 'Default Category' }}">
        </a>
    </div>
    <div class="py-1 h-full px-1">
        <p class="text-sm font-bold {{App::getLocale() == 'ar' ? 'font-IBM' : 'font-crimson'}} text-[#333] mb-1">
            {{ $product->category->name ?? 'Default Category' }}
        </p>
        <h3 class="text-sm text-[#1c1d1d] font-normal">
            {{ $product->name }}
        </h3>
        @if($product->discounted_price)
            <h3 class="font-bold text-sm">
                {{--                {{ number_format($product->discounted_price, 2) }}  {{ __('front.'.$currency) }}--}}
                {{App::getLocale()  == 'en' ? Number::currency($product->discounted_price, $currency): number_format($product->discounted_price, 2) .' '. __('front.'.$currency)}}

                | <span
                    class="line-through font-light text-[#333]">{{ number_format($product->original_price, 2) }}</span>
            </h3>
        @else
            <h3 class="font-bold text-sm">
                {{App::getLocale()  == 'en' ? Number::currency($product->original_price, $currency): number_format($product->original_price, 2) .' '. __('front.'.$currency)}}
            </h3>
        @endif
    </div>
</div>
