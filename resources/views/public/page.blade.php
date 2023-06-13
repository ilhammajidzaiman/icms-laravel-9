@extends('public.templates.layout')
@section('container')
    <section class="wrapper pt-5">
        <div class="container mt-5 p-3">
            <div class="row g-4">
                <div class="col-12 col-md-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="text-capitalize">
                                <a href="{{ route('page', $page->slug) }}" class="text-reset">
                                    {{ $page->title }}
                                </a>
                            </h3>
                            <div class="card-text">{!! $page->content !!}</div>
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
