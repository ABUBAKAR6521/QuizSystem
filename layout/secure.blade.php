<!DOCTYPE html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title') | {{ config('app.name', 'Quiz System Admin') }}</title>
    @include('partials.css_includes')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    <div class="container-scroller">
        @include('partials.header_includes')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar_includes')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('table_header')
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer_includes')
        @include('partials.js_includes')
    </div>
</body>
@yield('page_scripts')

</html>
