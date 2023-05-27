@extends('private.templates.layout')

@section('header')
    rincian user
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <form action="{{ route('developer.management.user.update', $user->uuid) }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group text-capitalize m-0">
                                @php
                                    $path = $user->path;
                                    $file = $user->file;
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
                            <div class="row">
                                <x-form-input-row-readonly type="text" name="name" label="nama"
                                    value="{{ $user->name }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row-readonly type="text" name="username" label="username"
                                    value="{{ $user->username }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row-readonly type="text" name="email" label="email"
                                    value="{{ $user->email }}" class="col-md-6" />
                            </div>
                            <div class="row">
                                <x-form-input-row-readonly type="text" name="level" label="level"
                                    value="{{ $user->level->name }}" class="col-md-4" />
                            </div>
                            <div class="row">
                                <x-form-input-row-readonly type="text" name="status" label="status"
                                    value="{{ $user->status->name }}" class="col-md-4" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
