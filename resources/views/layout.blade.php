<!doctype html>
<html lang="{{ App::getLocale() }}">
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
<body style="background-image: url({{ $background }});">
<div class="fadein">
  <header class="row">
    <div class="small-12 columns">
      @include('nav')
    </div>
  </header>

  <div id="content">
    <div class="row">
      @yield('content')
    </div>
  </div>

  <div id="footer" class="row">
    <div class="small-12 columns text-right">
      <span>
        {{ trans('app.background_credits') }}
        <a href="https://www.facebook.com/PhotographyByZlat" target="_blank">
          Zlatina Tochkova
        </a>
      </span>
      <br />
      <span>
        <a href="https://github.com/ash-rain/microbrander" target="_blank">
          {{ trans('app.open_source') }}
        </a>
      </span>
    </div>
  </div>
</div>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/fastclick.js') }}"></script>
  <script src="{{ asset('js/foundation.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
  <script>
    $(document).foundation();
    @yield('js')
  </script>
</body>
</html>
