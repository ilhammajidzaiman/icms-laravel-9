@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="../" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ $segmentForm.'/'.$menu->slug }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <x-private.form.input-row type="number" name="order" label="urutan"
                            :value="old('order',$menu->order)" class="col-md-2" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="name" label="nama" :value="old('name',$menu->name)"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="icon" label="icon" :value="old('icon',$menu->icon)"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="url" label="url" :value="old('url',$menu->url)"
                            class="col" />
                    </div>
                    <x-private.button.button-save />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection