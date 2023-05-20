@extends('private.templates.main')

@section('header')
    user baru
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <form action="{{ route('developer.management.user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 p-5">
                @php
                    $url = url('assets/images/default-user.svg');
                @endphp
                <x-form-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <x-form-input-row type="text" name="name" label="nama" :value="old('name')"
                                class="col-md-4" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="username" label="username" :value="old('username')"
                                class="col-md-4" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="email" label="email" :value="old('email')"
                                class="col-md-6" />
                        </div>
                        <div class="form-row">
                            <x-form-input-password name="password" label="password" class="col-md-6" />
                            <x-form-input-password name="confirmation" label="konfirmasi password" class="col-md-6" />
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <x-form-input-select name="status" label="status" class="col-md-4">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status') == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </x-form-input-select>
                        </div>
                        <div class="form-row">
                            <x-form-input-select name="level" label="level" class="col-md-4">
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}" @selected(old('level') == $level->id)>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </x-form-input-select>
                        </div>
                        <x-button-submit label="simpan" class="btn-primary" icon="fa-save" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('/assets/js/image-preview.js') }}"></script>
@endsection
