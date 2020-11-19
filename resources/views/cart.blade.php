@extends('layouts.otoraty.master')

@section('content')
    <!-- ****** CART ********* -->
    <section class="cart" data-aos="fade-up" data-aos-offset="200">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="mb-5 d-inline-block cart__heading"><span><i
                                    class="fas fa-cart-plus"></i></span> @lang('Cart') </h3>
                    <div class="cart__box">
                        @foreach(app('cart')->getItems() as $item)
                            <div class="cart__inner d-flex justify-content-between align-items-center">
                                <div class="cart__inner--box">
                                    <div class="img">
                                        <img src="{{ $item->item->getFirstMediaUrl() }}" alt="">
                                    </div>
                                    <div class="cart__inner--box-product">
                                        <h5>
                                            <a href="">{{ $item->item->name }}</a>
                                            <h3 class="price">
                                                {{ price($item->item->getPrice()) }}
                                                <bdi>X</bdi>
                                                {{ $item->qty }}
                                            </h3>
                                        </h5>
                                    </div>
                                </div>
                                <div class="cart__inner--quan d-flex flex-column">
                                    {{ BsForm::delete(LaravelLocalization::localizeURL(url('/cart'))) }}
                                    {{ Form::hidden('item_id', $item->item->id) }}
                                    {{ Form::hidden('item_type', $item->item->getMorphClass()) }}
                                    <button class="btn btn__remove" type="submit">@lang('Delete') <span><i
                                                    class="far fa-trash-alt"></i></span></button>
                                    {{ BsForm::close() }}
                                    <input type="hidden"
                                           form="cart-update"
                                           name="cart[{{ $item->item->getMorphClass() }}{{ $item->item->id }}][item_id]"
                                           value="{{ $item->item->id }}">
                                    <input type="hidden"
                                           form="cart-update"
                                           name="cart[{{ $item->item->getMorphClass() }}{{ $item->item->id }}][item_type]"
                                           value="{{ $item->item->getMorphClass() }}">
                                    <input type="number"
                                           form="cart-update"
                                           name="cart[{{ $item->item->getMorphClass() }}{{ $item->item->id }}][qty]"
                                           class="form-control" value="{{ $item->qty }}" min="1">
                                </div>
                            </div>
                        @endforeach
                        {{ BsForm::put(LaravelLocalization::localizeURL(url('/cart/update')), ['id' => 'cart-update']) }}
                        {{ BsForm::close() }}
                        <div class="cart__bottom d-flex justify-content-end align-items-center mt-5">
                            <strong class="mx-4">@lang('Total') :
                                {{ price(app('cart')->getSubTotal()) }}
                            </strong>
                            <button class="btn btn__cart" type="submit" form="cart-update">@lang('Update Cart')</button>
                            <a href="{{ url('checkout') }}" class="btn btn__cart">{{ trans('front_footer.continue_to_checkout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
