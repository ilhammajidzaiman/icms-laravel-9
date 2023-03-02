@extends('private.templates.main')
@section('container')
<x-button-link-pill :href="'../'.$profil->uuid.'/edit'" label="kembali" class="btn-sm btn-outline-secondary mb-3"
    icon="fa-arrow-left" />

<form action="{{ $segmentForm }}" method="post">
    @method('put')
    @csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-password name="old" label="password lama" class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <x-form-input-password name="password" label="password" class="col-md-6" />
                        <x-form-input-password name="confirmation" label="konfirmasi password" class="col-md-6" />
                    </div>
                    <x-button-submit label="simpan" class="btn-primary" icon="fa-save" />
                </div>
            </div>

        </div>
    </div>
</form>
@endsection