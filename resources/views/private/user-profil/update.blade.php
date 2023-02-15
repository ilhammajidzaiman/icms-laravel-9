@extends('private.templates.main')
@section('container')
<x-private.button.link-back :href="'../'.$profil->uuid" />

<form action="{{ $segmentForm.'/'.$profil->uuid .'/edit'}}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-3">
            @php
            $value=$profil->file;
            $value == 'default-user.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
            @endphp
            <x-private.form.input-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="name" label="nama"
                            :value="old('name',$profil->name)" class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="username" label="username"
                            :value="old('username',$profil->username)" class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="email" label="email"
                            :value="old('email',$profil->email)" class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            Ganti password
                            <a href="{{ $segmentForm.'/'.$profil->uuid.'/password' }}">disini</a>
                        </div>
                    </div>

                    {{-- <div class="form-row">
                        <x-private.form.input-password name="confirmation" label="konfirmasi password"
                            class="col-md-6" />
                    </div> --}}

                    <x-private.button.button-save />
                </div>
            </div>
        </div>
    </div>
</form>
@endsection