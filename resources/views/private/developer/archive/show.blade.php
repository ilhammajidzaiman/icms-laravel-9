@extends('private.templates.layout')

@section('header')
    rincian berkas
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.archive.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <p class="card-text">
                            <x-badge class="rounded-pill bg-{{ $archive->status->color }}"
                                label="{{ $archive->status->name }}" />
                        </p>
                        <h6 class="card-title">
                            {{ $archive->title }}
                        </h6>
                        <p class="card-text">
                            <x-field-date :create="$archive->created_at" :update="$archive->updated_at" class="text-muted" />
                        </p>
                        @php
                            $file = $archive->file;
                            $path = $archive->path;
                            $extensionFile = explode('.', $file);
                            $extension = Str::lower(end($extensionFile));
                            $file == 'default-img.svg' ? ($url = asset('assets/file/' . $file)) : ($url = asset('storage/' . $path . $file));
                        @endphp
                        @if ($extension === 'pdf')
                            <div class="ratio ratio-16x9">
                                <embed type="application/pdf" src="{{ $url }}" class="img-fluid w-100"></embed>
                            </div>
                        @endif
                        @if ($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png' || $extension === 'svg')
                            <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid w-100">
                        @endif
                        @if (
                            $extension === 'doc' ||
                                $extension === 'xls' ||
                                $extension === 'ppt' ||
                                $extension === 'docx' ||
                                $extension === 'xlsx' ||
                                $extension === 'pptx')
                            <h1>{{ $url }}</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
