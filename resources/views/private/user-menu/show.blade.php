@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="./" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="order" label="urutan"
                        :value="old('order',$menu->order)" class="col-md-2" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="name" label="nama"
                        :value="old('name',$menu->name)" class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="icon" label="icon"
                        :value="old('icon',$menu->icon)" class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="prefix" label="prefix"
                        :value="old('prefix',$menu->prefix)" class="col" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="url" label="url" :value="old('url',$menu->url)"
                        class="col" />
                </div>

                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="created_at" label="dibuat"
                        :value="$menu->created_at->format('d-m-Y, H:i:s').', '.$menu->created_at->diffForHumans()"
                        class="col" />
                    <x-private.form.input-row-readonly type="text" name="updated_at" label="diedit"
                        :value="$menu->updated_at->format('d-m-Y, H:i:s').', '.$menu->updated_at->diffForHumans()"
                        class="col" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection