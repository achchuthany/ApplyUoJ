<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.title-meta')
        @include('layouts.head')
  </head>

    <body class="bg-white">
        @yield('content')
        @include('layouts.vendor-scripts')
    </body>
</html>
