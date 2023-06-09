<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/' . config('app.icon')) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <style>
        .text-shadow {
            color: #ffffff;
            text-shadow: 0 0 3px #000000;
        }

        .carousel-item-overlay {
            position: relative;
        }

        .carousel-item-overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2));
            /* background-color: rgba(0, 0, 0, 0.5); */
        }

        .carousel-item-overlay img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .carousel-item-overlay .carousel-caption-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }
    </style>
    <style>
        @media (min-width: 992px) {

            /* Desktop */
            .navbar-nav .dropdown:hover>.dropdown-menu {
                display: block;
            }
        }

        @media (max-width: 991px) {
            .navbar-nav .dropdown:hover>.dropdown-menu {
                display: none;
            }

            .navbar-nav .dropdown:hover>.dropdown-menu.show {
                display: block;
            }
        }

        @media (min-width: 768px) {
            .navbar-nav .dropdown:hover>.dropdown-toggle::after {
                animation: rotateArrow 0.3s linear forwards;
            }

            .navbar-nav .dropdown:not(:hover)>.dropdown-toggle::after {
                animation: unrotateArrow 0.3s linear forwards;
            }
        }

        @media (max-width: 767px) {
            .navbar-nav .dropdown-toggle::after {
                animation: none;
                color: #3d3d3d;
            }

            .nav-link {
                color: #3d3d3d;
            }

            .nav-link:hover {
                color: #000000;
                font-weight: bold
            }
        }

        @keyframes rotateArrow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(180deg);
            }
        }

        @keyframes unrotateArrow {
            from {
                transform: rotate(180deg);
            }

            to {
                transform: rotate(0deg);
            }
        }
    </style>
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

            <div class="container">
                <div class="footer clearfix">
                    <div class="float-start">
                        <p><?= date('Y') ?> &copy; {{ config('app.name') }}</p>

                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <i class="bi bi-people fs-1"></i>
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Hank Schrader</h5>
                                <h6 class="text-muted mb-0">@johnducky</h6>
                            </div>
                        </div>
                    </div>
                    <div class="float-end">
                        <p>
                            Copyright
                            <a href="{{ route('/') }}">{{ config('app.copyright') }}</a>
                        </p>
                    </div>
                </div>
            </div>


        </section>



    </div>
    <script src="{{ asset('/plugins/mazer/assets/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
