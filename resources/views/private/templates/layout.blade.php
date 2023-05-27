<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/' . config('app.icon')) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app-dark.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/shared/iconly.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset('/plugins/mazer/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    @yield('style')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                @include('private.templates.sidebar-header')
                @include('private.templates.sidebar-menu')
            </div>
        </div>


        <div id="main" class='layout-navbar'>
            @include('private.templates.nav')
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        @include('private.templates.title')
                    </div>
                    <section class="section">
                        @yield('container')
                    </section>
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                                by <a href="https://ahmadsaugi.com">Saugi</a></p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('/plugins/mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/plugins/mazer/assets/js/app.js') }}"></script>
    <!-- Need: Apexcharts -->
    <script src="{{ asset('/plugins/mazer/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/plugins/mazer/assets/js/pages/dashboard.js') }}"></script>
    @yield('script')

</body>

</html>
