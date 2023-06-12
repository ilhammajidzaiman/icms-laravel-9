@extends('private.templates.layout')

@section('header')
    rincian galeri
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.galery.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                @php
                    $file = $galery->file;
                    $path = $galery->path;
                    $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                @endphp
                <img src="{{ $url }}" alt="{{ $url }}" class="card-img-top w-100">
                <div class="card-body pt-4 pb-0 mb-0">
                    <h6 class="card-title">
                        {{ $galery->title }}
                    </h6>
                </div>
                <div class="card-footer border-0">
                    <p class="card-text">
                        <x-field-date :create="$galery->created_at" :update="$galery->updated_at" class="text-muted" />
                    </p>
                    <span class="float-start">
                        <x-badge class="badge rounded-pill bg-{{ $galery->status->color }}"
                            label="{{ $galery->status->name }}" />
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
