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
</head>

<body id="home">
    {{-- <div id="app"> --}}
    <div id="main" class="layout-horizontal">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ route('/') }}">
                    <img src="{{ asset('assets/images/' . config('app.icon')) }}" alt="Logo {{ config('app.icon') }}"
                        width="30" height="30" class="d-inline-block align-text-top">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">
                            <a href="{{ route('/') }}" class="text-reset">
                                {{ config('app.name') }}
                            </a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                            @forelse ($navMenuParents as $navMenuParent)
                                @php
                                    $hasParent = App\Models\NavMenu\navMenuParent::where('id', $navMenuParent->id)->first();
                                    //
                                    $hasChild = App\Models\NavMenu\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)->first();
                                    //
                                    $navMenuChildren = App\Models\NavMenu\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)
                                        ->orderBy('order')
                                        ->get();
                                @endphp
                                @if ($hasChild)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href=" {{ $navMenuParent->url }}"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $navMenuParent->name }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach ($navMenuChildren as $navMenuChild)
                                                <li>
                                                    <a class="dropdown-item" href="{{ $navMenuChild->url }}">
                                                        {{ $navMenuChild->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{ $navMenuParent->url }}">
                                            {{ $navMenuParent->name }}
                                        </a>
                                    </li>
                                @endif
                            @empty
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Menu</a>
                                </li>
                            @endforelse
                        </ul>
                        <form action="{{ route('/') }}" method="get" class="d-flex" role="search">
                            <div class="input-group">
                                <button type="submit" id="button-addon1" class="btn btn-light text-capitalize">
                                    <i class="bi bi-search"></i>
                                    cari
                                </button>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    class="form-control" placeholder="disini...">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <section class="wrapper pt-5">
            <div id="carouselControls1" class="carousel slide mt-4 pt-3" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($slideshows as $slideshow)
                        @php
                            $no == 0 ? ($class = 'active') : ($class = '');
                        @endphp
                        <button type="button" data-bs-target="#carouselControls1"
                            data-bs-slide-to="{{ $no++ }}" class="{{ $class }}" aria-current="true"
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
        </section>

        <section class="wrapper pt-5">
            <div class="container p-3">
                <div class="row g-4">
                    <div class="col-12 col-md-7">
                        <div id="carouselControls2" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($slideArticles as $slideArticle)
                                    @php
                                        $no == 0 ? ($class = 'active') : ($class = '');
                                    @endphp
                                    <button type="button" data-bs-target="#carouselControls2"
                                        data-bs-slide-to="{{ $no++ }}" class="{{ $class }}"
                                        aria-current="true" aria-label="slide {{ $loop->iteration }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($slideArticles as $slideArticle)
                                    @php
                                        $no == 0 ? ($class = 'active') : ($class = '');
                                    @endphp
                                    <div class="carousel-item <?= $class ?>" data-bs-interval="3500">
                                        @php
                                            $file = $slideArticle->file;
                                            $path = $slideArticle->path;
                                            $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                        @endphp
                                        <img src="{{ $url }}" class="d-block w-100"
                                            alt="{{ $url }}" aria-label="slide {{ $no++ }}">
                                        <div class="carousel-caption d-none d-md-block text-shadow">
                                            {{-- <h5> --}}
                                            <a href="{{ route('/') }}" class="h5 text-reset">
                                                {{ $slideArticle->title }}
                                            </a>
                                            {{-- </h5> --}}
                                            <p>{{ $slideArticle->truncated }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls2"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls2"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <h3>
                            New Article
                        </h3>
                        @foreach ($newArticles as $newArticle)
                            <div class="card mb-3">
                                <div class="card-body p-3">
                                    <div class="row g-4">
                                        <div class="col-8 col-md-8">
                                            <a href="{{ route('/') }}" class="card-text text-reset">
                                                {{ $newArticle->title }}
                                            </a>
                                            <div class="card-text">
                                                <small class="text-muted">
                                                    {{ $newArticle->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-4">
                                            @php
                                                $file = $newArticle->file;
                                                $path = $newArticle->path;
                                                $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                            @endphp
                                            <img src="{{ $url }}" class="img-fluid rounded-3"
                                                alt="{{ $url }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="wrapper pt-5" id="article">
            <div class="container mt-5 p-3">
                <h3 class="border-3 border-bottom border-primary mb-5">
                    Article
                </h3>
                <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                    @forelse ($articles as $article)
                        <div class="col-12 col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <small class="card-text text-muted">
                                        <div>
                                            {{ $article->created_at->diffForHumans() }}
                                        </div>
                                        <div>
                                            {{ $article->created_at->format('d-m-Y, H:i:s') }}
                                        </div>
                                    </small>
                                </div>
                                @php
                                    $file = $article->file;
                                    $path = $article->path;
                                    $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                @endphp
                                <img src="{{ $url }}" alt="{{ $url }}"
                                    class="card-img-top w-100 rounded-4">
                                <div class="card-body pt-4 pb-0 mb-0">
                                    <h5 class="card-title">
                                        <a href="{{ route('/') }}" class="text-reset">
                                            {{ $article->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        {{ $article->truncated }}
                                    </p>
                                </div>
                                <div class="card-footer border-0">
                                    <p class="card-text">
                                        <span class="h6 text-capitalize">
                                            kategori:
                                        </span>
                                        @php
                                            $categories = App\Models\Blog\BlogPost::where('blog_article_id', $article->id)
                                                ->orderBy('id')
                                                ->with(['category'])
                                                ->get();
                                        @endphp
                                        @forelse ($categories as $category)
                                            {{ $category->category->name }},
                                        @empty
                                            tidak ada kategori
                                        @endforelse
                                    </p>
                                    <div class="text-end">
                                        <a href="{{ route('/') }}"
                                            class="btn btn-light-primary  float-end text-capitalize">
                                            selengkapnya...
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>

        <footer class="wrapper pb-5" id="footer">
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
        </footer>

        {{-- </div> --}}
    </div>
    <script src="{{ asset('/plugins/mazer/assets/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
