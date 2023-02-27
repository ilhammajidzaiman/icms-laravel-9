@extends('private.templates.main')
@section('container')
<x-button-link-pill :href="'../'.$profil->uuid" label="kembali" class="btn-sm btn-outline-secondary mb-3"
    icon="fa-arrow-left" />

<form action="{{ $segmentForm.'/edit'}}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-3">
            @php
            $value=$profil->file;
            $value == 'default-user.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
            @endphp
            <x-form-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row type="text" name="name" label="nama" :value="old('name',$profil->name)"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="username" label="username"
                            :value="old('username',$profil->username)" class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="email" label="email" :value="old('email',$profil->email)"
                            class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            Ganti password
                            <a href="{{ $segmentForm.'/password' }}">disini</a>
                        </div>
                    </div>
                    <x-button-submit label="simpan" class="btn-primary" icon="fa-save" />
                </div>
            </div>
        </div>
    </div>
</form>
@endsection