@extends('layouts.otoraty.master', ['title' => $product->name])

@section('content')
    <!-- ******** PRODUCT DETAILS ********* -->
    <section class="product-details" data-aos="fade-up" data-aos-offset="200">
        <div class="container-fluid">
            <div class="section__top-header d-flex mb-3">
                <p class="d-inline-block">
                    <span class="mx-3">
                        <i class="fas fa-arrow-left"></i>
                    </span>{{ $product->category->name }}</p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="product__carousel">
                        <!-- Swiper and EasyZoom plugins start -->
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                @foreach($product->getMedia() as $media)
                                    <div class="swiper-slide easyzoom easyzoom--overlay">
                                        <a href="#">
                                            <img src="{{ $media->getFullUrl() }}" alt=""/>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($product->getMedia() as $media)
                                    <div class="swiper-slide">
                                        <img src="{{ $media->getFullUrl() }}" alt=""/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Swiper and EasyZoom plugins end -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="product-details--box pl-5">
                        <div class="product__details--top d-flex align-items-start mb-4">
                            <div class="product-details-right">
                                <p><span><i class="fas fa-arrow-left mt-2"></i></span>{{ $product->name }}</p>
                                {{--                                <div class="stars d-flex">--}}
                                {{--                                    <span><i class="far fa-star"></i></span>--}}
                                {{--                                    <span><i class="fas fa-star"></i></span>--}}
                                {{--                                    <span><i class="fas fa-star"></i></span>--}}
                                {{--                                    <span><i class="fas fa-star"></i></span>--}}
                                {{--                                    <span><i class="fas fa-star"></i></span>--}}
                                {{--                                </div>--}}
                            </div>
                            <button class="btn"><i class="far fa-heart"></i></button>
                        </div>
                        @if($product->getDiscount() > 0)
                            <div class="text-left text-danger mb-4"><s>{{ price($product->price) }}</s></div>
                        @endif
                        <div class="price text-left mb-4">{{ price($product->getPrice()) }}</div>

                        <h4 class="mb-4">تفاصيل المنتج</h4>
                        <p class="mb-4">{!! $product->description !!}</p>
                        <div class="product__box--bottom d-flex justify-content-between align-items-center mb-4">
                            {{ BsForm::post(LaravelLocalization::localizeURL(url('/cart')), ['class' => 'form__details d-flex justify-content-between w-100 align-items-end']) }}
                            {{ Form::hidden('item_id', $product->id) }}
                            {{ Form::hidden('item_type', $product->getMorphClass()) }}
                            <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                            <div class="counter__product">
                                <button type="button" class="sub btn">-</button>
                                <input type="number" name="qty" class="qty" value="1" min="1" max="3"/>
                                <button type="button" class="add btn">+</button>
                            </div>

                            <button class="btn btn__cart" type="submit">@lang('Add to cart') <i
                                        class="fas fa-cart-plus"></i></button>
                            {{ BsForm::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($sameCategory->count())
        <section class="products">
            <div class="container-fluid">
                <div class="section__header text-center mb-5">
                    <h3>@lang('Products in same category')</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="owl-product owl-carousel owl-theme">
                            @foreach($sameCategory as $product)
                                @include('layouts.otoraty.partials.product-item')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($sameBrand->count())
        <section class="products">
            <div class="container-fluid">
                <div class="section__header text-center mb-5">
                    <h3>@lang('Products in same brand')</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="owl-product owl-carousel owl-theme">
                            @foreach($sameBrand as $product)
                                @include('layouts.otoraty.partials.product-item')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif



@endsection