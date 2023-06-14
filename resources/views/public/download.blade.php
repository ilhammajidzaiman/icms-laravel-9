@extends('public.templates.layout')
@section('container')
    <section class="wrapper pt-5">
        <div class="container mt-5 p-3">
            <div class="row g-4">
                <div class="col-12 col-md-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="text-capitalize">
                                <a href="{{ route('download') }}" class="text-reset">
                                    download
                                </a>
                            </h3>
                            <ul class="list-group list-group-flush">
                                @forelse ($archives as $archive)
                                    <li class="list-group-item">
                                        {{ $loop->iteration }}.
                                        <a href="{{ asset('storage/' . $archive->path . $archive->file) }}" target="_blank"
                                            class="text-reset">
                                            {{ $archive->title }}
                                        </a>
                                        <span class="float-end">
                                            <a href="{{ route('download.file', $archive->uuid) }}" target="_blank">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </span>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
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
