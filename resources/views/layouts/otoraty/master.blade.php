<!DOCTYPE html>
<html lang="en" dir="{{ Locales::getDir() == 'rtl' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ***** TITLE FAVICON ***** -->
    <link rel="shortcut icon" href="{{ asset('otoraty-design') }}/img/favicon.png">

    <!-- ***** FONTAWESOME LIBRARY FOR ICON FONTS. ***** -->
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/jquery.range.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>

    <!-- ***** INCLUDE BOOTSTRAP CDN  ***** -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- ------------- ***** SLICK SLIDER ******** -->
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/easyzoom.css">
    <!-- ***** Montserrat FONT PUBLIC ***** -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- INCLUDE MAIN STYLE SHEET *****-->
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/rtl-style.css">
    @if(Locales::getDir() == 'ltr')
        <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/direction-en.css">
    @endif
    <link rel="stylesheet" href="{{ asset('otoraty-design') }}/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css">

    @stack('styles')
    <title>{{ !empty($title) ? $title .' | '. config('app.name', 'Laravel') : config('app.name', 'Laravel')}}</title>
</head>
<body>

<!-- ******* HEADER ******** -->
<div class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="top-header__inner d-flex justify-content-center">
                    <ul class="list-unstyled d-flex">
                        <li>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle d-flex justify-content-between align-items-center"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    {{ country()->name }} <span><img src="{{ country()->getFirstMediaUrl('flags') }}"
                                                                     width="30px"
                                                                     alt=""></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach(\App\Models\Country::all() as $country)
                                        <a class="dropdown-item" href="{{ url('/', $country->code) }}">
                                            {{ $country->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="mx-4">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle d-flex justify-content-between align-items-center"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <span><i class="fas fa-globe"></i></span> {{ Locales::getName() }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach(Locales::get() as $locale)
                                        <a class="dropdown-item" rel="alternate" hreflang="{{ $locale->code }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($locale->code, null, [], true) }}">
                                            {{ $locale->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle d-flex justify-content-between align-items-center"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <span><i class="fas fa-dollar-sign"></i></span> {{ currency()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach(\App\Models\Currency::all() as $currency)
                                        <a class="dropdown-item"
                                           href="{{ url('/currencies/'.$currency->id) }}">{{ $currency->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ********* HEADER CENTERED ********* -->
<header class="header__centered py-5 px-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="header__centered--wrapper d-flex justify-content-start align-items-center">
                    <div class="logo">
                        <a href="{{ url('/')  }}" class="header__logo">
                            {{ Settings::locale()->get('name') }}</a>
                    </div>
                    <form action="#" class="form__search">
                        <div class="form-group">
                            <input type="search" class="form-control input__search" placeholder="بحث">
                            <select onchange="location.href = '/categories/' + this.value" name="category_id"
                                    class="form-control select__form" id="exampleFormControlSelect1">
                                <option>@lang('categories.plural') <span><i class="fas fa-angle-down"></i></span>
                                </option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn__search" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    @guest
                        <a href="#loginForm" class="btn btn__login" data-toggle="modal" data-target="#loginForm">
                            @lang('Login Or Register')
                        </a>
                    @else
                        <div class="dropdown">
                            <button class="btn d-flex justify-content-between align-items-center"
                                    type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <img src="{{ auth()->user()->getAvatar() }}"
                                     class="mr-2"
                                     alt="avatar"
                                     style="width: 32px; height: 32px; border-radius: 50%;">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/orders') }}">
                                    @lang('My Orders')
                                </a>
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault();document.getElementById('logoutForm').submit()">
                                    @lang('dashboard.auth.logout')
                                </a>
                                <form style="display: none;" action="{{ route('logout') }}" method="post"
                                      id="logoutForm">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <a href="{{ url('/wishlist') }}">
                            <span class="btn"><i class="fa fa-heart fa-lg"></i></span>
                        </a>
                    @endguest
                    <a href="{{ url('/cart') }}" class="btn btn-transparent position-relative">
                        <span class="badge badge-danger position-absolute"
                              style="left: 0">{{ count(session('cart', [])) ? count(session('cart', [])) : '' }}</span>
                        <span>
                            <i class="fas fa-cart-plus fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
@guest()
    <!-- Modal LOGIN-->
    <div class="modal modal__login fade" id="loginForm" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('dashboard.auth.login.title')</h5>
                    <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('login') }}" method="post" class="form__login">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="email" class="mb-3">@lang('dashboard.auth.login.email')<span
                                        class="text-danger">*</span></label>
                            <input type="email"
                                   name="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="mb-3">@lang('dashboard.auth.login.password')<span
                                        class="text-danger">*</span></label>
                            <input type="password"
                                   name="password"
                                   autocomplete="current-password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        </div>
                        <div class="form__login--bottom mb-4 d-flex justify-content-between align-items-center">
                            <button class="btn btn__modal--submit"
                                    type="submit">@lang('dashboard.auth.login.submit')</button>
                            {{--                            <a href="#">نسيت كلمة المــرور</a>--}}
                        </div>
                        <div class="form__login--footer text-center">
                            <a href="{{ route('register') }}">@lang('dashboard.auth.register.title')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endguest

<nav class="navbar navbar-expand-lg px-5">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-align-justify"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.categories.show', $category) }}">
                            {{ $category->name }}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="list-unstyled social__icons d-flex mr-auto">
                @if(Settings::get('instagram'))
                    <li class="mx-2">
                        <a href="{{ Settings::get('instagram') }}">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                @endif
                @if(Settings::get('twitter'))
                    <li class="mx-2">
                        <a href="{{ Settings::get('twitter') }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                @endif
                @if(Settings::get('snapchat'))
                    <li class="mx-2">
                        <a href="{{ Settings::get('snapchat') }}">
                            <i class="fab fa-snapchat-ghost"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="my-4 container">
    @include('flash::message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@yield('content')
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 m-auto">
                <div class="footer__inner">
                    <h4 class="footer__heading mb-4">{{ trans('front_footer.our_services') }}</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.replacement_and_retrieval') }}</a>
                        </li>
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.delivery_service') }}</a>
                        </li>
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.terms_and_conditions') }}</a>
                        </li>
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.about_us') }}</a>
                        </li>
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.about') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 m-auto">
                <div class="footer__inner">
                    <ul class="list-unstyled">
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.common_questions') }}</a>
                        </li>
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.help') }}</a>
                        </li>
                        <li class="d-flex">
                            <div class="dot"></div>
                            <a href="">{{ trans('front_footer.contact_us') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 m-auto">
                <div class="footer__inner">
                    <h4 class="footer__heading mb-4">@lang('Follow Us')</h4>
                    <ul class="list-unstyled social__icons d-flex mr-auto">
                        @if(Settings::get('instagram'))
                            <li class="mx-2">
                                <a href="{{ Settings::get('instagram') }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if(Settings::get('twitter'))
                            <li class="mx-2">
                                <a href="{{ Settings::get('twitter') }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if(Settings::get('snapchat'))
                            <li class="mx-2">
                                <a href="{{ Settings::get('snapchat') }}">
                                    <i class="fab fa-snapchat-ghost"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <h4 class="footer__heading mb-4">@lang('Download App')</h4>
                    <div class="footer__apps d-flex mw-100">
                        <a href="{{ Settings::get('apple') }}">
                            <img src="{{ asset('otoraty-design') }}/img/ios.png"
                                 style="height: 150px;"
                                 alt="">
                        </a>
                        <a href="{{ Settings::get('android') }}">
                            <img src="{{ asset('otoraty-design') }}/img/android.png"
                                 style="height: 150px;"
                                 class="mx-2"
                                 alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copyright text-center py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p>{{ Settings::locale()->get('copyright') }}</p>
            </div>
        </div>
    </div>
</div>


<!-- ================== *INCLUDE JAVASCRIPT FILES*. =================== -->

<!-- ***** INCLUDE JQUERY LIBRARY ***** -->
<script src="{{ asset('/otoraty-design/js/jquery-3.3.1.min.js') }}"></script>
<!-- ***** INCLUDE POPPER FOR DYNAMICALLY POSITIONS IN BOOTSTRAP ***** -->
<script src="{{ asset('/otoraty-design/js/popper.min.js') }}"></script>
<!-- ***** INCLUDE BOOTSTRAP FRAMEWORK ***** -->
<script src="{{ asset('/otoraty-design/js/bootstrap.js') }}"></script>
<script src="{{ asset('/otoraty-design/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/otoraty-design/js/swiper.min.js') }}"></script>
<script src="{{ asset('/otoraty-design/js/easyzoom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 2000,
  });
</script>
<!-- **** INCLUDE MAIN FILE.JS ***** -->
<script src="{{ asset('/otoraty-design/js/index.js') }}"></script>
@if(($errors->has('email') || $errors->has('password')) && ! request()->routeIs('register'))
    <script>
      $('#loginForm').modal();
    </script>
@endif
@stack('scripts')
</body>
</html>
