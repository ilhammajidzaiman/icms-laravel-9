@extends('private.templates.layout')

@section('header')
    user baru
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <form action="{{ route('developer.management.user.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group text-capitalize">
                                @php
                                    $url = url('assets/images/default-user.svg');
                                @endphp
                                <img src="{{ $url }}" alt="{{ $url }}"
                                    class="img-fluid rounded w-100 mb-3 img-preview">
                                <label for="file" class="form-label">profil</label>
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
                                <x-form-input-row type="text" name="name" label="nama" value="{{ old('name') }}"
                                    class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="username" label="username"
                                    value="{{ old('username') }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="email" label="email" value="{{ old('email') }}"
                                    class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="password" name="password" label="password" value=""
                                    class="col-md-6" />
                                <x-form-input-row type="password" name="confirmation" label="konfirmasi" value=""
                                    class="col-md-6" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <x-form-input-select name="level" label="level" class="col-md-4">
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}" @selected(old('level') == $level->id)>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </x-form-input-select>
                            </div>
                            <div class="row">
                                <x-form-input-select name="status" label="status" class="col-md-4">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" @selected(old('status') == $status->id)>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </x-form-input-select>
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
