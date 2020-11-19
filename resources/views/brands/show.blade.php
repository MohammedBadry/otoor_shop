@extends('layouts.otoraty.master', ['title' => $brand->name])

@section('content')
    <!-- ******* CATEGORY ********** -->
    <section class="category" data-aos="fade-down" data-aos-offset="200">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="category__menu">
                        <h4 class="category__heading">تســـوق حسب</h4>
                        <h5 class="px-4 mb-2">السعر</h5>
                        <form action="#" class="form-range px-4">

                            <!-- With number fields -->
                            <div class="filter level-filter level-req">
                                <div id="rangeSlider" class="range-slider">
                                    <div class="number-group mb-4">
                                        <small for="min">الحد الأدنى</small>
                                        <b id="price_from">{{ request('price_from', 0) }}</b>
                                        <small>الى</small>
                                        <b id="price_to">{{ request('price_to', $maxPrice) }}</b>
                                        <small for="max">الحد الأقصى</small>
                                    </div>

                                    <div class="range-group">
                                        <div id="slider"></div>
                                    </div>
                                </div>
                            </div><!-- // filter level-filter -->

                            <h4 class="category__heading my-5">{{ $brand->name }}</h4>
                            <div class="check__category d-flex justify-content-between">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">

                    <div class="section__top-header d-flex mb-3">
                        <p class="d-inline-block">
                            <span class="mx-3">
                                <i class="fas fa-arrow-left"></i>
                            </span> {{ $brand->name }}
                        </p>
                    </div>
                    <p class="mb-5 category__sub--heading">{{ $brand->description }}</p>
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-4">
                                @include('layouts.otoraty.partials.product-item')
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
      var sliderElement = document.getElementById('slider');
      var slider = noUiSlider.create(sliderElement, {
        start: [parseInt('{{ request('price_from', 0) }}'), parseInt('{{ request('price_to', $maxPrice ?? 1) }}')],
        connect: true,
        range: {
          'min': 0,
          'max': parseInt('{{ $maxPrice }}')
        },
        pips: {mode: 'count', values: 5},
        direction: '{{ Locales::getDir() }}',
      });
      slider.on('update', function (values) {
        document.getElementById('price_from').innerText = values[0];
        document.getElementById('price_to').innerText = values[1];
      });
      slider.on('end', function (values) {
        let urlWithoutQuery = location.href.split('?')[0];
        var search = location.search.substring(1);
        var query = [];
        if (search) {
          query = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}')
        }
        query.price_from = values[0];
        query.price_to = values[1];
        var qs = Object.keys(query)
          .map(key => `${key}=${query[key]}`)
          .join('&');
        location.href = urlWithoutQuery+'?'+qs;
      });
    </script>
@endpush