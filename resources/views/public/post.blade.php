@extends('public.templates.layout')
@section('container')
    <section class="wrapper pt-5">
        <div class="container mt-5 p-3">
            <div class="row g-4">
                <div class="col-12 col-md-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <small class="text-capitalize">
                                {{ $article->created_at->diffForHumans() . ', ' . $article->created_at->format('d-m-Y, H:i:s') }}
                                <i class="bi bi-eye ms-2"></i>
                                {{ $article->counter }}
                                x
                            </small>
                            <h3>
                                <a href="{{ route('post', $article->slug) }}" class="text-reset">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-capitalize">
                                oleh:
                                {{ $article->user->name }}
                            </p>
                            @php
                                $file = $article->file;
                                $path = $article->path;
                                $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                            @endphp
                            <img src="{{ $url }}" alt="{{ $url }}"
                                class="img-fluid rounded w-100 mb-3 mb-4">
                            <div class="card-text">{!! $article->content !!}</div>
                            <h6 class="text-capitalize mt-4">
                                kategori:
                            </h6>
                            <nav style="--bs-breadcrumb-divider: ',';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    @php
                                        $categories = App\Models\Blog\BlogPost::where('blog_article_id', $article->id)
                                            ->orderBy('id')
                                            ->with(['category'])
                                            ->get();
                                    @endphp
                                    @forelse ($categories as $category)
                                        <li class="breadcrumb-item">
                                            <a href="">{{ $category->category->name }}</a>
                                        </li>
                                    @empty
                                        <li class="breadcrumb-item">
                                            tidak ada kategori
                                        </li>
                                    @endforelse
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    @include('public.templates.article-new')
                    @include('public.templates.article-popular')
                </div>
            </div>
        </div>
    </section>
@endsection
