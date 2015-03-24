<!doctype html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  
  <link href='http://fonts.googleapis.com/css?family=Comfortaa:400,700&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('css/foundation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/flag-icon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>@yield('css')</style>
  @yield('head')
  <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body>
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1>
          <a id="logo" href="{{ url('/') }}">
          	<img src="{{ url('/img/globe.png') }}" />
          </a>
        </h1>
      </li>
      <li class="toggle-topbar menu-icon">
        <a href="javascript:void(0)"><span>{{ trans('app.menu') }}</span></a>
      </li>
    </ul>

    <section class="top-bar-section">
      <ul class="right">
        <li class="has-dropdown">
          <a href="javascript:void(0)">
            <span class="flag left flag-icon-background flag-icon-{{ App::getLocale() == 'en' ? 'gb' : App::getLocale() }}">&nbsp; &nbsp; &nbsp;</span>
            <span class="show-for-small-only">
              &nbsp; {{ config('app.locales')[App::getLocale()] }}
            </span>
          </a>
          <ul class="dropdown">
            @foreach (config('app.locales') as $locale => $display)
              <li {!! App::getLocale() == $locale ? 'class="active"' : '' !!}>
                <a href="{{ url("/language/$locale") }}">
                  <span class="flag flag-icon-background flag-icon-{{ $locale == 'en' ? 'gb' : $locale }}">&nbsp; &nbsp; &nbsp;</span>
                  {{ $display }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
        <li>
          @if(Auth::check())
          <a href="{{ action('Auth\AuthController@getLogout') }}">
            {{ Auth::user()->name }}
          </a>
          @else
          <a href="{{ action('Auth\AuthController@getIndex') }}">
            <i class="fa fa-sign-in"></i>
            {{ trans('app.login') }}
          </a>
          @endif
        </li>
        <li>
          <a href="{{ action('CartController@index') }}">
            <i class="fa fa-shopping-cart"></i>
            {{ trans('app.cart') }}
            @if(!Cart::isEmpty())
            <span id="cart" class="round label">
              {{ Cart::getContent()->count() }}
            </span>
            @endif
          </a>
        </li>
      </ul>
      <ul class="left">
        <li class="{{ Request::is('templates/*') ? 'active' : '' }}">
          <a href="{{ action('TemplateController@index') }}">{{ trans('Templates') }}</a>
        </li>
        <li class="{{ Request::is('products/*') ? 'active' : '' }}">
          <a href="{{ action('ProductController@index') }}">{{ trans('Products') }}</a>
        </li>
      </ul>
    </section>
  </nav>

  <div id="content">
    <div class="row">
      @yield('content')
    </div>
  </div>

  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/fastclick.js') }}"></script>
  <script src="{{ asset('js/foundation.js') }}"></script>
  @yield('scripts')
  <script>
    $(document).foundation();
    @yield('js')
  </script>
</body>
</html>