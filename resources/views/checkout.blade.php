@extends('layouts.otoraty.master')

@section('content')
    <!-- ****** CHECKOUT ********* -->
    <section class="checkout" data-aos="fade-up" data-aos-offset="200">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <form action="{{ LaravelLocalization::localizeURL(url('/coupons')) }}" method="post"
                          id="coupon-form">
                        @csrf
                    </form>
                    <form action="{{ LaravelLocalization::localizeURL(url('checkout')) }}"
                          id="checkout" method="POST" class="form-info">
                        @csrf
                        <h5 class="d-flex mb-5">
                            <div class="icon ml-4"><i class="fas fa-list-alt"></i></div> @lang('Information') </h5>
                        <div class="form-group mb-3">
                            <label for="user[name]">@lang('Name')</label>
                            <input type="text" id="user[name]" name="user[name]"
                                   required
                                   value="{{ data_get(old('user'), 'name') }}"
                                   class="form-control">
                        </div>
                        @guest
                            <div class="form-group mb-3">
                                <label for="user[email]">@lang('Email')</label>
                                <input type="email" id="user[email]"
                                       name="user[email]"
                                       required
                                       value="{{ data_get(old('user'), 'email') }}"
                                       class="form-control">
                            </div>
                        @endguest
                        <div class="form-group mb-3">
                            <label for="user[phone]">@lang('Phone')</label>
                            <input type="text" id="user[phone]"
                                   name="user[phone]"
                                   required
                                   value="{{ data_get(old('user'), 'phone') }}"
                                   class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="city">@lang('City')</label>
                            <input type="text" name="city" required value="{{ old('city') }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="area">@lang('Area')</label>
                            <input type="text" name="area" required value="{{ old('area') }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="street">@lang('Street')</label>
                            <input type="text" name="street" required value="{{ old('street') }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">@lang('Address')</label>
                            <textarea type="text" name="address" required rows="3"
                                      class="form-control">{{ old('address') }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    @if(! session('coupon'))
                        <div class="checkout-coupon d-flex">
                            <div class="icon ml-3"><i class="fas fa-plus"></i></div>
                            <p class="mb-3">@lang('Apply Coupon')</p>
                        </div>
                        <div class="form-group">
                            <input name="code" form="coupon-form" required type="text"
                                   class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <button form="coupon-form" class="btn btn-gray btn-gray-active"
                                    type="submit">@lang('Apply')</button>
                        </div>
                    @endif
                    <div class="form-group">
                        <p class="my-4"><span class="ml-4"><i class="fas fa-arrow-left"></i></span>@lang('Send a gift')
                        </p>
                        <textarea name="gift_message" form="checkout" id="gift_message" cols="30" rows="5"
                                  placeholder="@lang('Gift Message')"
                                  class="form-control">{{ old('gift_message') }}</textarea>

                        <button class="btn btn-gray btn-gray-active" form="checkout"
                                type="submit">@lang('Complete Order')</button>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-result">
                        <h6>@lang('Total')</h6>
                        <h3 class="font-weight-bold">{{ price(app('cart')->getTotal()) }}</h3>
                    </div>
                    @if(session('coupon'))
                        <div class="checkout-result">
                            <h6>@lang('Discount')</h6>
                            <h3 class="font-weight-bold"><s>{{ price(app('cart')->getDiscount()) }}</s>
                            </h3>
                        </div>
                    @endif
                    <div class="form-info form-payment">
                        <div class="form-info-top d-flex my-4">
                            <p><span class="ml-4"><i class="fas fa-credit-card"></i></span> طريقة الدفع</p>
                        </div>
                        @foreach($paymentMethods as $paymentMethod)
                            <div class="form-group d-flex mb-4">
                                <input type="radio" name="payment_method" form="checkout" class="form-control"
                                       value="{{ data_get($paymentMethod, 'PaymentMethodId') }}" id="payment-{{ data_get($paymentMethod, 'PaymentMethodId') }}">
                                <label for="payment-{{ data_get($paymentMethod, 'PaymentMethodId') }}" class="d-flex">
                                    <img src="{{ data_get($paymentMethod, 'ImageUrl') }}" width="50px" class="ml-3" alt="">
                                    <span>
                                        @if(app()->getLocale() == 'ar')
                                            {{ data_get($paymentMethod, 'PaymentMethodAr') }}
                                        @else
                                            {{ data_get($paymentMethod, 'PaymentMethodEn') }}
                                        @endif
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection