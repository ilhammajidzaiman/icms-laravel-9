@extends('private.templates.layout')

@section('header')
    profil
@endsection

@section('container')
    {{-- <x-button-link href="{{ route(Request::segment(1) . '.profil.edit', $profil->uuid) }}" label="edit"
        class="rounded-pill btn btn-md btn-outline-success mb-3" icon="fa-fw fas fa-edit" /> --}}

    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group text-capitalize m-0">
                            @php
                                $path = $profil->path;
                                $file = $profil->file;
                                $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                            @endphp
                            <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <x-description-list label="nama" value="{{ $profil->name }}" />
                        <x-description-list label="username" value="{{ $profil->username }}" />
                        <x-description-list label="email" value="{{ $profil->email }}" />
                        <x-description-list label="status" value="{{ $profil->status->name }}" />
                        <x-description-list label="level" value="{{ $profil->level->name }}" />
                        <x-description-list label="dibuat"
                            value="{{ $profil->created_at->diffForHumans() . ', ' . $profil->created_at->format('d-m-Y, H:i:s') }}" />
                        <x-description-list label="diubah"
                            value="{{ $profil->updated_at->diffForHumans() . ', ' . $profil->updated_at->format('d-m-Y, H:i:s') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
