@extends('private.templates.layout')

@section('header')
    edit profil
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.profil.index', $profil->uuid) }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-secondary mb-3" icon="fa-fw fas fa-arrow-left" />

    <form action="{{ route(Request::segment(1) . '.profil.update', $profil->uuid) }}" method="post"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group text-capitalize">
                                @php
                                    $path = $profil->path;
                                    $file = $profil->file;
                                    $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                @endphp
                                <img src="{{ $url }}" alt="{{ $url }}"
                                    class="img-fluid rounded w-100 mb-3 img-preview">
                                <label for="file" class="form-label">thumbnail</label>
                                <input type="file" name="file" id="file" class="form-control"
                                    accept=".jpg,.jpeg,.png" onchange="previewImg()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <x-form-input-row type="text" name="name" label="nama"
                                    value="{{ old('name', $profil->name) }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="username" label="username"
                                    value="{{ old('username', $profil->username) }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="email" label="email"
                                    value="{{ old('email', $profil->email) }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="password" class="form-label text-capitalize">password</label>
                                    <div class="form-control-static" id="password">
                                        Ganti password
                                        <a href="{{ route(Request::segment(1) . '.profil.password.edit', $profil->uuid) }}"
                                            class="fw-bold">
                                            disini
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-button-submit label="simpan" class="btn btn-primary" icon="fa-fw fas fa-save" />
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('/assets/js/image-preview.js') }}"></script>
@endsection
