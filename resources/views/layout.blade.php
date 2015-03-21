<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <link rel="stylesheet" href="{{ asset('css/foundation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/flag-icon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('head')
  <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body>
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1>
          <a href="{{ url('/') }}">KVO DA E</a>
        </h1>
      </li>
      <li class="toggle-topbar menu-icon">
        <a href="javascript:void(0)"><span>{{ trans('Menu') }}</span></a>
      </li>
    </ul>

    <section class="top-bar-section">
      <ul class="right">
        <li class="has-dropdown">
          <a href="javascript:void(0)">
            <span class="flag flag-icon-background flag-icon-{{ App::getLocale() == 'en' ? 'gb' : App::getLocale() }}">&nbsp; &nbsp; &nbsp;</span>
          </a>
          <ul class="dropdown">
            @foreach (config('app.locales') as $locale => $display)
              <li {!! session('lang') == $locale ? 'class="active"' : '' !!}>
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
          <a href="{{ action('Auth\AuthController@getLogin') }}">
            {{ Auth::user()->name }}
          </a>
          @else
          <a href="{{ action('Auth\AuthController@getLogin') }}">
            <i class="fa fa-sign-in"></i>
            {{ trans('Login') }}
          </a>
          @endif
        </li>
        <li class="has-dropdown">
          <a href="javascript:void(0)">
            <i class="fa fa-shopping-cart"></i>
            {{ trans('Cart') }}
            <span class="round label">3</span>
          </a>
          <ul class="dropdown">
            <li><a href="javascript:void(0)">First link</a></li>
            <li><a href="javascript:void(0)">Link in dropdown</a></li>
          </ul>
        </li>
      </ul>
      <ul class="left">
        <li>
          <a href="{{ action('TemplateController@index') }}">{{ trans('Templates') }}</a>
        </li>
      </ul>
    </section>
  </nav>

  <div class="row">
    <h1>@yield('title')</h1>
    @yield('content')
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