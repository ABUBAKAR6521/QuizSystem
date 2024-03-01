<!DOCTYPE html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title') | {{ config('app.name', 'Quiz System Admin') }}</title>
    @include('partials.css_includes')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body>
        @include('partials.header_includes')
        <div class="container-fluid main">
            <div class="container">
                @yield('content')
            </div>
        </div>
        @include('partials.footer_includes')
        @include('partials.js_includes')
</body>
@yield('page_scripts')

</html>
