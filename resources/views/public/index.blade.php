@extends('public.templates.layout')
@section('container')
    @include('public.templates.slideshow')
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
                                    data-bs-slide-to="{{ $no++ }}" class="{{ $class }}" aria-current="true"
                                    aria-label="slide {{ $loop->iteration }}"></button>
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
                                    <img src="{{ $url }}" class="d-block w-100" alt="{{ $url }}"
                                        aria-label="slide {{ $no++ }}">
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
                            <img src="{{ $url }}" alt="{{ $url }}" class="card-img-top w-100 rounded-4">
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
                                    <a href="{{ route('/') }}" class="btn btn-light-primary  float-end text-capitalize">
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
@endsection
