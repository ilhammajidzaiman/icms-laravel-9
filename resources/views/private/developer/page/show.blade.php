@extends('private.templates.layout')

@section('header')
    rincian halaman
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.page.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- <div class="card">
                <div class="card-content">
                    <div class="card-body"> --}}
            <h3>{{ $page->title }}</h3>
            <x-field-date :create="$page->created_at" :update="$page->updated_at" class="text-capitalize" />
            <div>{!! $page->content !!}</div>
            {{-- </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
