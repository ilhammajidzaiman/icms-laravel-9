@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="./" />

<form action="{{ $segmentForm.'/'.$profil->uuid }}" method="post">
    @method('put')
    @csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-private.form.input-password name="old" label="password lama" class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-password name="password" label="password" class="col-md-6" />
                        <x-private.form.input-password name="confirmation" label="konfirmasi password"
                            class="col-md-6" />
                    </div>
                    <x-private.button.button-save />
                </div>
            </div>

        </div>
    </div>
</form>
@endsection