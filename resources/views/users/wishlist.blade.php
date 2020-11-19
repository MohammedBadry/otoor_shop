@extends('layouts.otoraty.master', ['title' => trans('products.favorites')])

@section('content')
    <!-- ****** WHISHLIST ********* -->
    <section class="whistlist" data-aos="fade-down" data-aos-offset="200">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="mb-5 d-inline-block cart__heading"><span><i
                                    class="far fa-heart"></i></span> @lang('products.favorites')
                        ({{ auth()->user()->favorites()->count() }})
                    </h3>
                    @foreach($favoriteProducts as $product)
                        <div class="cart__box">
                            <div class="cart__inner d-flex justify-content-between align-items-center">
                                <div class="cart__inner--box">
                                    <div class="img">
                                        <img src="{{ $product->getFirstMediaUrl() }}" alt="">
                                    </div>
                                    <div class="cart__inner--box-product">
                                        <h5>
                                            <a href="">{{ $product->name }}</a>
                                            <h3 class="price">{{ price($product->price) }}</h3>
                                        </h5>
                                    </div>
                                </div>
                                <div class="cart__inner--quan d-flex flex-column">
                                    @can('removeFromFavorite', $product)
                                        {{ BsForm::delete(LaravelLocalization::localizeURL(route('products.favorites.remove', $product))) }}
                                        <button class="btn btn__remove" type="submit">
                                            @lang('products.actions.remove-from-favorite')
                                            <span><i class="far fa-trash-alt"></i></span>
                                        </button>
                                        {{ BsForm::close() }}
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection