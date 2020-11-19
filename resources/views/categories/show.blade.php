@extends('layouts.otoraty.master', ['title' => $category->name])

@section('content')
    <!-- ******* CATEGORY ********** -->
    <section class="category" data-aos="fade-down" data-aos-offset="200">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="category__menu">
                        <h4 class="category__heading">{{ trans('categories.shop_by') }}</h4>
                        <h5 class="px-4 mb-2">{{ trans('categories.price') }}</h5>
                        <form action="#" class="form-range px-4">

                            <!-- With number fields -->
                            <div class="filter level-filter level-req">
                                <div id="rangeSlider" class="range-slider">
                                    <div class="number-group mb-4">
                                        <small for="min">{{ trans('categories.minimum') }}</small>
                                        <b id="price_from">{{ request('price_from', 0) }}</b>
                                        <small>{{ trans('categories.to') }}</small>
                                        <b id="price_to">{{ request('price_to', $maxPrice) }}</b>
                                        <small for="max">{{ trans('categories.maximum') }}</small>
                                    </div>

                                    <div class="range-group">
                                        <div id="slider"></div>
                                    </div>
                                </div>
                            </div><!-- // filter level-filter -->

                            <h4 class="category__heading my-5">{{ $category->name }}</h4>
                            <div class="check__category d-flex justify-content-between">
                                <div class="form-check-right d-flex">
                                    <div class="form-check">
                                        <input onchange="location.href = '{{ route('web.categories.show', $category) }}'"
                                               class="form-check-input position-static" type="checkbox" id="em"
                                               value="option1" aria-label="...">
                                    </div>
                                    <label for="em">{{ $category->name }}</label>
                                </div>
                                <span>({{ \App\Models\Product::whereHas('categories', function ($query) use($category) {
    $query->where('category_id', $category->id);
})->count() }})</span>
                            </div>
                            @foreach($category->subcategories as $subcategory)
                                <div class="check__category d-flex justify-content-between">
                                    <div class="form-check-right d-flex">
                                        <div class="form-check">
                                            <input onchange="location.href = '{{ route('web.categories.show', $subcategory) }}'"
                                                   class="form-check-input position-static" type="checkbox" id="em"
                                                   value="option1" aria-label="...">
                                        </div>
                                        <label for="em">{{ $subcategory->name }}</label>
                                    </div>
                                    <span>({{ \App\Models\Product::whereHas('categories', function ($query) use($subcategory) {
    $query->where('category_id', $subcategory->id);
})->count() }})</span>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">

                    <div class="section__top-header d-flex mb-3">
                        @if($category->parent)
                            <p class="d-inline-block">
                            <span class="mx-3">
                                <i class="fas fa-arrow-left"></i>
                            </span> {{ $category->parent->name }}
                            </p>
                        @endif
                        <p class="d-inline-block">
                            <span class="mx-3">
                                <i class="fas fa-arrow-left"></i>
                            </span> {{ $category->name }}
                        </p>
                    </div>
                    <p class="mb-5 category__sub--heading">{{ $category->description }}</p>
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
