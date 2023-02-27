@extends('private.templates.main')
@section('container')
<x-button-link-pill :href="'../'" label="kembali" class="btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ $segmentForm.'/'.$level->slug }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <x-form-input-row type="text" name="name" label="nama" :value="old('name',$level->name)"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="color" label="warna" :value="old('color',$level->color)"
                            class="col-md-4" />
                    </div>
                    <x-button-submit label="simpan" class="btn-primary" icon="fa-save" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection