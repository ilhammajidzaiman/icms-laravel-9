<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/' . config('app.icon')) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app-dark.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/shared/iconly.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}"> --}}
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
    @yield('style')
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('/') }}">
                        <img src="{{ asset('assets/images/' . config('app.logo')) }}" alt="Logo">
                        {{ config('app.name') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div id="carouselControls1" class="carousel slide" data-bs-ride="carousel">
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
                            <div class="carousel-caption carousel-caption-overlay d-none d-md-block mt-5 pt-5 ">
                                <h3 class="text-reset">{{ $slideshow->title }}</h3>
                                <p>{{ $slideshow->detail }}</p>
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

            <div class="wrapper py-5">
                <div class="container px-3">
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
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselControls2" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselControls2" data-bs-slide="next">
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
            </div>

            <div class="wrapper py-5">
                <div class="container px-3">
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
            </div>
            <footer class="wrapper py-5">
                <div class="container">
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
        </div>
    </div>

    <script src="{{ asset('/plugins/mazer/assets/js/bootstrap.js') }}"></script>
    {{-- <script src="{{ asset('/plugins/mazer/assets/js/app.js') }}"></script> --}}
    <script src="{{ asset('/plugins/mazer/assets/js/pages/horizontal-layout.js') }}"></script>
    @yield('script')
</body>

</html>
