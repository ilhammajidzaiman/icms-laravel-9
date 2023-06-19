@extends('private.templates.layout')

@section('header')
    sampah slideshow
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.slideshow.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <x-alert-dismissing />

    <form action="{{ route(Request::segment(1) . '.slideshow.trash.index') }}" method="get">
        @csrf
        <div class="row justify-content-end mb-3">
            <x-search-input name="search" id="search" value="{{ request('search') }}" class="col-md-4" />
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($slideshows as $slideshow)
            <div class="col-12 col-md-6">
                <div class="card h-100">
                    @php
                        $file = $slideshow->file;
                        $path = $slideshow->path;
                        $file == 'default-slideshow.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                    @endphp
                    <img src="{{ $url }}" alt="{{ $url }}" class="card-img-top w-100">
                    <div class="card-body pt-4 pb-0 mb-0">
                        <h6 class="card-title">
                            {{ $slideshow->title }}
                        </h6>
                        <p class="card-text">
                            {{ $slideshow->detail }}
                        </p>
                    </div>

                    <div class="card-footer border-0">
                        <p class="card-text">
                            <x-field-date-delete :delete="$slideshow->deleted_at" class="text-secondary" />
                        </p>
                        <span class="float-start">
                            <x-badge class="rounded-pill bg-{{ $slideshow->status->color }}"
                                label="{{ $slideshow->status->name }}" />
                        </span>
                        <span class="float-end">
                            <x-button-link
                                href="{{ route(Request::segment(1) . '.slideshow.trash.restore', $slideshow->slug) }}"
                                label="pulihkan" class="rounded-pill btn btn-sm btn-outline-info"
                                icon="fa-fw fas fa-recycle" />
                            <x-button-delete
                                href="{{ route(Request::segment(1) . '.slideshow.trash.delete', $slideshow->slug) }}"
                                confirm="permanen {{ $slideshow->title }}" label="hapus"
                                class="rounded-pill btn btn-sm btn-outline-danger" icon="fa-fw fas fa-trash" />
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <x-alert-empty label="Tidak ada sampah ditemukan..." />
            </div>
        @endforelse
    </div>
    <div class="pt-3">
        <x-pagination :pages="$slideshows" side="1" />
    </div>
@endsection
