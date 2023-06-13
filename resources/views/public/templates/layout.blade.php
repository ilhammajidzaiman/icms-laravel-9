<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/' . config('app.icon')) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}"> --}}


    @yield('style')
</head>

<body id="home">
    <div id="main" class="layout-horizontal">
        @include('public.templates.navbar')
        @yield('container')
        {{-- <footer class="wrapper pb-5" id="footer">
            <div class="container mt-5 p-3">
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?= date('Y') ?> &copy; {{ config('app.name') }}</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Copyright
                            <a href="{{ route('/') }}">{{ config('app.copyright') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer> --}}
        <section id="contac" class="text-bg-primary">
            <div class="container p-3">
                <div class="row align-items-center py-5">
                    <div class="col-12 col-md-6">
                        <div class="text-center text-sm-center text-md-start">
                            <img src="{{ asset('assets/images/' . config('app.icon')) }}"
                                alt="Logo {{ config('app.icon') }}" width="50" height="50"
                                class="text-center text-sm-center text-md-start mb-3">

                            <h4 class="text-center text-sm-center text-md-start text-light ">
                                <a class="text-reset" href="{{ route('/') }}">
                                    {{ config('app.name') }}
                                </a>
                            </h4>
                            <p class="text-center text-sm-center text-md-start">
                                Copyright &copy; <?= date('Y') ?>
                                {{ config('app.copyright') }}
                            </p>
                        </div>
                        <p class="text-capitalize">
                            <i class="bi bi-building"></i>
                            jalan, kecamatan, kabupaten, provinsi
                        </p>
                        <p class="text-capitalize">
                            <i class="bi bi-telephone"></i>
                            +62 801 2345 6789
                        </p>
                        <p class="text-lowercase">
                            <i class="bi bi-envelope"></i>
                            email@developer.dev
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="text-capitalize">
                            <h4 class="text-lightt">Social Media</h4>
                            <ul class="list-inline">
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-github"></i>
                                </a>
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-youtube"></i>
                                </a>
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-tiktok"></i>
                                </a>
                                <a href="{{ route('/') }}" class="list-inline-item text-reset fs-3">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-secondary text-center py-2">
                <small>
                    &copy; {{ date('Y') }} {{ config('app.name') }}.
                    All rights reserved.
                </small>
            </div>
        </section>
    </div>
    <script src="{{ asset('/plugins/mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/plugins/js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('/plugins/bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('/plugins/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/plugins/js/masonry.pkgd.min.js') }}"></script>
</body>

</html>
