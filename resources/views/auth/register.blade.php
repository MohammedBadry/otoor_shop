@extends('layouts.otoraty.master')

@section('content')
    <section class="form__register">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" data-aos="fade-up" data-aos-offset="200">
                        <article class="card-body">
                            <h4 class="card-title mt-3 text-center">@lang('dashboard.auth.register.title')</h4>
                            <p class="text-center">@lang('dashboard.auth.register.greeting')</p>
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name"
                                           value="{{ old('name') }}"
                                           autofocus
                                           placeholder="@lang('dashboard.auth.register.name')"
                                           type="text">
                                </div> <!-- form-group// -->
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    </div>
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="@lang('dashboard.auth.register.email')">
                                </div> <!-- form-group// -->
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                    </div>
                                    <input type="text"
                                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="@lang('auth.attributes.phone')">
                                </div> <!-- form-group// -->
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           required
                                           name="password"
                                           autocomplete="new-password"
                                           placeholder="@lang('dashboard.auth.register.password')">
                                </div> <!-- form-group// -->
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input type="password"
                                           class="form-control"
                                           required
                                           name="password_confirmation"
                                           autocomplete="new-password"
                                           placeholder="@lang('dashboard.auth.register.password_confirmation')">
                                </div> <!-- form-group// -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn__create--account">@lang('dashboard.auth.register.submit')
                                    </button>
                                </div>
                            </form>
                        </article>
                    </div> <!-- card.// -->
                </div>
            </div>
        </div>
    </section>
@endsection
