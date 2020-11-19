@extends('layouts.otoraty.master')

@section('content')

    <div class="alert__body text-center my-3 p-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <p>@lang('Delivery within Kuwait is free')</p>
                </div>
            </div>
        </div>
    </div>

    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">

            @foreach($slider as $image)
                <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                    <img src="{{ $image->getFullUrl() }}"
                         class="d-block w-100"
                         alt="{{ $image->file_name }}">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="products">
        <div class="container-fluid">
            <div class="section__header text-center mb-5">
                <h3>@lang('Best seller')</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-product owl-carousel owl-theme" data-aos="fade-up" data-aos-offset="200">
                        @foreach($bestSellerProducts as $product)
                            @include('layouts.otoraty.partials.product-item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="notice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 m-auto">
                    <div class="notice__inner" data-aos="fade-up" data-aos-offset="200">
                        {!! Settings::locale()->get('block1') !!}
                    </div>
                </div>
                <div class="col-lg-6 m-0 p-0">
                    <div class="img-left" data-aos="fade-right">
                        <img src="{{ optional(Settings::instance('block1-img'))->getFirstMediaUrl('block1-img') }}"
                             alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="brands">
        <div class="container-fluid">
            <div class="section__header text-center mb-5">
                <h3>{{ trans('brands.plural') }}</h3>
            </div>
            <div class="row" data-aos="fade-up" data-aos-offset="200">
                @foreach(\App\Models\Brand::all() as $brand)
                    <div class="col">
                        <div class="brands__box">
                            <a href="{{ route('web.brands.show', $brand) }}">
                                <img src="{{ $brand->getFirstMediaUrl() }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="products">
        <div class="container-fluid">
            <div class="section__header text-center mb-5">
                <h3>{{ trans('collections.plural') }}</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-offset="200">
                    <div class="owl-product owl-carousel owl-theme">
                        @foreach($collections as $product)
                            @include('layouts.otoraty.partials.product-item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="notice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-0 p-0" data-aos="fade-left" data-aos-offset="200">
                    <div class="img-left">
                        <img src="{{ optional(Settings::instance('block2-img'))->getFirstMediaUrl('block2-img') }}"
                             alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 m-auto">
                    <div class="notice__inner" data-aos="fade-right" data-aos-offset="200">
                        {!! Settings::locale()->get('block2') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section class="products" data-aos="fade-up" data-aos-offset="200">--}}
{{--        <div class="container">--}}
{{--            <div class="section__header text-center mb-5">--}}
{{--                <h3>@lang('Testers')</h3>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                @foreach($testers as $product)--}}
{{--                    <div class="col-lg-4 col-md-4">--}}
{{--                        @include('layouts.otoraty.partials.product-item')--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

@endsection
