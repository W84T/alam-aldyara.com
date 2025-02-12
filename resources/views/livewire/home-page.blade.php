<div class="flex flex-col gap-9 md:px-24 md:my-8">
    <div>
        <div class="swiper swiper-banner">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide !h-[30rem] rounded-xl overflow-hidden">
                        <div class="flex lg:flex-row flex-col h-full">
                            <div class="bg-[#f7f7f7] lg:w-1/3 flex flex-col items-center justify-center p-6">
                                <img class="!max-w-[250px]" src="{{url('storage', $banner->image)}}"
                                     alt="{{$banner->title}}">
                                <h1 class="text-2xl font-bold mt-4">{{$banner->title}}</h1>
                                <p class="font-lighter text-center">{{$banner->description}}</p>
                            </div>
                            <div class="lg:w-2/3">
                                <img class="h-full w-full object-cover" src="{{url('storage', $banner->hero_image)}}"
                                     alt="{{$banner->title}}">
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{--            <div class="swiper-pagination"></div>--}}

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>


    <div class="relative">

        <div class="flex justify-between items-start md:items-center">
            <h1 class="text-start w-full md:text-center text-2xl font-semibold mb-2 mx-2">
                {{__("front.category")}}
            </h1>
        </div>

        <div class="swiper swiper-category">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                    <div class="swiper-slide !h-[10rem] relative rounded overflow-hidden">
                        <a href="{{ route('products', ['selected_categories' => $category->id]) }}">
                            <h3 class="text-white absolute w-full text-center font-bold text-2xl bottom-3 z-[2]">{{$category->name}}</h3>
                            <div class="absolute z-[1] w-full h-full bg-black opacity-25"></div>
                            <img class="h-full w-full object-cover" src="{{url('storage', $category->image)}}"
                                 alt="{{$category->name}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="hidden md:block">
            <button
                class="category-prev absolute top-1/2 -left-6 -translate-y-1/2 bg-white p-2 rounded-full text-white hover:bg-white z-[10] shadow">
                <x-heroicon-o-chevron-left class="w-6 h-6 text-black"/>
            </button>

            <button
                class="category-next absolute top-1/2 -right-6 -translate-y-1/2 bg-white p-2 rounded-full text-white hover:bg-white z-[10] shadow">
                <x-heroicon-o-chevron-right class="w-6 h-6 text-black"/>
            </button>
        </div>
    </div>

    <div class="relative">
        <div class="flex justify-between items-start">
            <h1 class="text-start md:text-center text-2xl font-semibold mb-2 mx-2">
                {{__('front.featured')}}
            </h1>
        </div>
        <div class="swiper swiper-product">
            <div class="swiper-wrapper">
                @foreach($products as $product)
                    <x-product-card :product="$product" :currency="$currency"/>
                @endforeach
            </div>
        </div>
        <div class="hidden md:block">
            <button
                class="product-prev absolute top-1/2 -left-6 -translate-y-1/2 bg-white p-2 rounded-full text-white hover:bg-white z-[10] shadow">
                <x-heroicon-o-chevron-left class="w-6 h-6 text-black"/>
            </button>

            <button
                class="product-next absolute top-1/2 -right-6 -translate-y-1/2 bg-white p-2 rounded-full text-white hover:bg-white z-[10] shadow">
                <x-heroicon-o-chevron-right class="w-6 h-6 text-black"/>
            </button>
        </div>
    </div>


    <div class="relative">

        <div class="flex justify-between items-start">
            <h1 class="text-start md:text-center text-2xl font-semibold mb-2 mx-2">
                {{__('front.discounts')}}
            </h1>
        </div>
        <div class="swiper swiper-product">
            <div class="swiper-wrapper">
                @foreach($discountProducts as $product)
                    <x-product-card :product="$product" :currency="$currency"/>
                @endforeach
            </div>
        </div>
        <div class="hidden md:block">
            <button
                class="swiper-button-prev absolute top-1/2 -left-6 -translate-y-1/2 bg-white p-2 rounded-full text-white hover:bg-white z-[10] shadow">
                <x-heroicon-o-chevron-left class="w-6 h-6 text-black"/>
            </button>

            <button
                class="swiper-button-next absolute top-1/2 -right-6 -translate-y-1/2 bg-white p-2 rounded-full text-white hover:bg-white z-[10] shadow">
                <x-heroicon-o-chevron-right class="w-6 h-6 text-black"/>
            </button>
        </div>
    </div>


</div>
