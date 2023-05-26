@extends('admin-lte.private.templates.main')

@section('header')
    profil
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.profil.edit', $profil->uuid) }}" label="edit"
        class="rounded-pill btn-sm btn-outline-success mb-3" icon="fa-edit" />
    <x-alert-dismissing />

    <div class="row">
        <div class="col-md-3 px-5">
            @php
                $path = $profil->path;
                $file = $profil->file;
                $file == 'default-user.svg' ? ($url = url('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
            @endphp
            <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100 mb-3 mb-4">
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <x-description-list label="nama" value="{{ $profil->name }}" />
                    <x-description-list label="username" value="{{ $profil->username }}" />
                    <x-description-list label="email" value="{{ $profil->email }}" />
                    <x-description-list label="status" value="{{ $profil->status->name }}" />
                    <x-description-list label="level" value="{{ $profil->level->name }}" />
                    <x-description-list label="dibuat" value="{{ $profil->created_at }}" />
                    <x-description-list label="diubah" value="{{ $profil->updated_at }}" />
                </div>
            </div>


        </div>
    </div>
@endsection
