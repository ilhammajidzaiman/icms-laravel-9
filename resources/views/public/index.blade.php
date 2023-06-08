<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/' . config('app.icon')) }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

            /* Mobile */
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
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light fixed-top shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img src="{{ asset('assets/images/' . config('app.icon')) }}" alt="Logo {{ config('app.icon') }}"
                    width="30" height="24" class="d-inline-block align-text-top">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menu 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menu 2</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Parent Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Child Menu 1</a></li>
                                <li><a class="dropdown-item" href="#">Child Menu 2</a></li>
                                <li><a class="dropdown-item" href="#">Child Menu 3</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="wrapper mt-5">
        <div id="carouselControls1 mt-5" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @php
                    $no = 0;
                @endphp
                @foreach ($slideshows as $slideshow)
                    @php
                        $no == 0 ? ($class = 'active') : ($class = '');
                    @endphp
                    <button type="button" data-bs-target="#carouselControls1" data-bs-slide-to="{{ $no++ }}"
                        class="{{ $class }}" aria-current="true"
                        aria-label="slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner rounded-0">
                @php
                    $no = 0;
                @endphp
                @foreach ($slideshows as $slideshow)
                    @php
                        $no == 0 ? ($class = 'active') : ($class = '');
                    @endphp
                    <div class="carousel-item carousel-item-overlay <?= $class ?>" data-bs-interval="5000">
                        @php
                            $file = $slideshow->file;
                            $path = $slideshow->path;
                            $file == 'default-slideshow.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                        @endphp
                        <img src="{{ $url }}" class="d-block w-100" alt="{{ $url }}"
                            aria-label="slide {{ $no++ }}">
                        <div class="carousel-caption carousel-caption-overlay mt-5">
                            <h3 class="text-reset d-none d-md-block">{{ $slideshow->title }}</h3>
                            <p class="d-none d-lg-block">{{ $slideshow->detail }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
