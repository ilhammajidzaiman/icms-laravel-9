@extends('private.templates.main')
@section('container')
<x-button-link-pill :href="'./'" label="kembali" class="btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="name" label="nama" :value="old('name',$level->name)"
                        class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="color" label="warna"
                        :value="old('color',$level->color)" class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="created_at" label="dibuat"
                        :value="$level->created_at->format('d-m-Y, H:i:s').', '.$level->created_at->diffForHumans()"
                        class="col" />
                    <x-form-input-row-readonly type="text" name="updated_at" label="diedit"
                        :value="$level->updated_at->format('d-m-Y, H:i:s').', '.$level->updated_at->diffForHumans()"
                        class="col" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection