@extends('layouts.otoraty.master')

@section('content')
    <section class="form__register">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" data-aos="fade-up" data-aos-offset="200">
                        <article class="card-body">
                            <h4 class="card-title mt-3 text-center">@lang('dashboard.auth.login.title')</h4>
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    </div>
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="@lang('dashboard.auth.login.email')">
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
                                           placeholder="@lang('dashboard.auth.login.password')">
                                </div> <!-- form-group// -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn__create--account">@lang('dashboard.auth.login.submit')
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