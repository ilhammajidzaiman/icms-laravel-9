@extends('public.templates.layout')
@section('container')
    <section class="wrapper pt-5">
        <div class="container mt-5 pt-5">
            <div class="row g-4">
                <div class="col-12 col-md-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="border-3 border-bottom border-primary mb-5">{{ $page->title }}</h3>
                            <small class="text-capitalize">
                                {{ $page->created_at->diffForHumans() . ', ' . $page->created_at->format('d-m-Y, H:i:s') }}
                            </small>
                            <div>{!! $page->content !!}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h3 class="border-3 border-bottom border-primary">
                                New Article
                            </h3>
                            @foreach ($newArticles as $newArticle)
                                <div class="row pt-4">
                                    <div class="col-8 col-md-8">
                                        <h6 class="card-text fw-normal">
                                            <a href="{{ route('/') }}" class="text-reset">
                                                {{ $newArticle->title }}
                                            </a>
                                        </h6>
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
                            @endforeach
                        </div>
                    </div>
                </div>


                {{-- <div class="col-12 col-md-5">
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
                </div> --}}
            </div>
        </div>
    </section>
@endsection
