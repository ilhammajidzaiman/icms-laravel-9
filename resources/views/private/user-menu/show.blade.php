@extends('private.templates.main')
@section('container')

<x-button-link :href="'./'" label="kembali" class="rounded-pill btn-sm btn-outline-secondary mb-3"
    icon="fa-arrow-left" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="order" label="urutan" :value="$menu->order"
                        class="col-md-2" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="name" label="nama" :value="$menu->name"
                        class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="icon" label="icon" :value="$menu->icon"
                        class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="prefix" label="prefix" :value="$menu->prefix"
                        class="col" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="url" label="url" :value="$menu->url" class="col" />
                </div>

                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="created_at" label="dibuat"
                        :value="$menu->created_at->diffForHumans().', '.$menu->created_at->format('d-m-Y, H:i:s')"
                        class="col" />
                    <x-form-input-row-readonly type="text" name="updated_at" label="diubah"
                        :value="$menu->updated_at->diffForHumans().', '.$menu->updated_at->format('d-m-Y, H:i:s')"
                        class="col" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection