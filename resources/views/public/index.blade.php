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
            <header class="">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ route('/') }}"><img src="{{ asset('assets/images/' . config('app.logo')) }}"
                                    alt="Logo">
                                <span class="ps-2">
                                    {{ config('app.name') }}
                                </span>
                            </a>
                        </div>
                        <div class="header-top-right">
                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>Forms</span>
                                </a>
                                <div class="submenu ">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">


                                        <ul class="submenu-group">

                                            <li class="submenu-item  has-sub">
                                                <a href="#" class='submenu-link'>Form Elements</a>


                                                <!-- 3 Level Submenu -->
                                                <ul class="subsubmenu">

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-element-input.html"
                                                            class="subsubmenu-link">Input</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-element-input-group.html"
                                                            class="subsubmenu-link">Input Group</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-element-select.html"
                                                            class="subsubmenu-link">Select</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-element-radio.html"
                                                            class="subsubmenu-link">Radio</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-element-checkbox.html"
                                                            class="subsubmenu-link">Checkbox</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-element-textarea.html"
                                                            class="subsubmenu-link">Textarea</a>
                                                    </li>

                                                </ul>

                                            </li>



                                            <li class="submenu-item  ">
                                                <a href="form-layout.html" class='submenu-link'>Form Layout</a>


                                            </li>



                                            <li class="submenu-item  has-sub">
                                                <a href="#" class='submenu-link'>Form Validation</a>


                                                <!-- 3 Level Submenu -->
                                                <ul class="subsubmenu">

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-validation-parsley.html"
                                                            class="subsubmenu-link">Parsley</a>
                                                    </li>

                                                </ul>

                                            </li>



                                            <li class="submenu-item  has-sub">
                                                <a href="#" class='submenu-link'>Form Editor</a>


                                                <!-- 3 Level Submenu -->
                                                <ul class="subsubmenu">

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-editor-quill.html"
                                                            class="subsubmenu-link">Quill</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-editor-ckeditor.html"
                                                            class="subsubmenu-link">CKEditor</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-editor-summernote.html"
                                                            class="subsubmenu-link">Summernote</a>
                                                    </li>

                                                    <li class="subsubmenu-item ">
                                                        <a href="form-editor-tinymce.html"
                                                            class="subsubmenu-link">TinyMCE</a>
                                                    </li>

                                                </ul>

                                            </li>

                                        </ul>


                                    </div>
                                </div>
                            </li>

                            <li class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-table"></i>
                                    <span>Table</span>
                                </a>
                                <div class="submenu ">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">


                                        <ul class="submenu-group">

                                            <li class="submenu-item  ">
                                                <a href="table.html" class='submenu-link'>Table</a>


                                            </li>



                                            <li class="submenu-item  ">
                                                <a href="table-datatable.html" class='submenu-link'>Datatable</a>


                                            </li>



                                            <li class="submenu-item  ">
                                                <a href="table-datatable-jquery.html" class='submenu-link'>Datatable
                                                    (jQuery)</a>


                                            </li>

                                        </ul>


                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>


                {{-- <div class="">
                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                                aria-current="true">
                            </li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="">
                            </li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="carousel-item carousel-item-next carousel-item-start">
                                <img src="{{ asset('/plugins/mazer/assets/images/samples/1.png') }}"
                                    class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                </div>
                            </div>
                            <div class="carousel-item active carousel-item-start">
                                <img src="{{ asset('/plugins/mazer/assets/images/samples/2.png') }}"
                                    class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div> --}}

            </header>



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
