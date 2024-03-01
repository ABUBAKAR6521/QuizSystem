<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title') | {{ config('app.name', 'Quiz System Admin') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    @include('partials.css_includes')
</head>

<body>
    <div class="container-scroller">
        @yield('content')
    </div>

    @include('partials.js_includes')
</body>

</html>
