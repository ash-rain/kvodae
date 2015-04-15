<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
  <title>@yield('title')</title>
  @include('header')
  <style>@yield('css')</style>
  @yield('head')
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.1/js/foundation.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
  <script>
    $(document).foundation();
    @yield('js')
  </script>
</body>
</html>
