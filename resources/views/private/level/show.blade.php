@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="./" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="name" label="nama"
                        :value="old('name',$level->name)" class="col-md-4" />
                </div>

                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="created_at" label="dibuat"
                        :value="$level->created_at" class="col" />
                    <x-private.form.input-row-readonly type="text" name="updated_at" label="diedit"
                        :value="$level->updated_at" class="col" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection