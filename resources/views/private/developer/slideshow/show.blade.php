@extends('private.templates.layout')

@section('header')
    rincian slideshow
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.slideshow.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12">
            <div class="card">
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
                        <x-field-date :create="$slideshow->created_at" :update="$slideshow->updated_at" class="text-muted" />
                    </p>
                    <span class="float-start">
                        <x-badge class="badge rounded-pill bg-{{ $slideshow->status->color }}"
                            label="{{ $slideshow->status->name }}" />
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
