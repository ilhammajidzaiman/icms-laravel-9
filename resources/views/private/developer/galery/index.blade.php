@extends('private.templates.layout')

@section('header')
    galery
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.galery.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    <x-alert-dismissing />


    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($galeries as $galery)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100">
                    @php
                        $file = $galery->file;
                        $path = $galery->path;
                        $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                    @endphp
                    <img src="{{ $url }}" alt="{{ $url }}" class="card-img-top w-100">
                    <div class="card-body pt-4 pb-0 mb-0">
                        <h6 class="card-title fw-normal">
                            {{ $galery->title }}
                        </h6>
                    </div>

                    <div class="card-footer border-0">
                        <p class="card-text">
                            <x-field-date :create="$galery->created_at" :update="$galery->updated_at" class="text-muted" />
                        </p>
                        <span class="float-start">
                            <x-badge class="rounded-pill bg-{{ $galery->status->color }}"
                                label="{{ $galery->status->name }}" />
                        </span>
                        <span class="float-end">
                            <x-button-link href="{{ route(Request::segment(1) . '.galery.show', $galery->uuid) }}"
                                label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                icon="fa-fw fas fa-eye" />
                            <x-button-link href="{{ route(Request::segment(1) . '.galery.edit', $galery->uuid) }}"
                                label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                icon="fa-fw fas fa-edit" />
                            <x-button-delete href="{{ route(Request::segment(1) . '.galery.delete', $galery->uuid) }}"
                                confirm="{{ $galery->title }}" label="hapus"
                                class="rounded-pill btn btn-sm btn-outline-danger" icon="fa-fw fas fa-trash" />
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <x-alert-empty label="Data tidak ditemukan..." />
            </div>
        @endforelse
    </div>
    <div class="pt-3">
        <x-pagination :pages="$galeries" side="1" />
    </div>
@endsection
