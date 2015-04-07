<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
  <title>@yield('title')</title>
  @include('header')
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

  @include('footer')
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
