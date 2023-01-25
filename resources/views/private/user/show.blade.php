@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="./" />

<div class="row">
    <div class="col-md-3">
        @php
        $value = $user->file;
        $value == 'default-user.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
        @endphp
        <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100 mb-3 mb-4">
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="name" label="nama" :value="$user->name"
                        class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="username" label="username"
                        :value="$user->username" class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="email" label="email" :value="$user->email"
                        class="col-md-6" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="created_at" label="dibuat pada"
                        :value="$user->created_at" class="col" />
                    <x-private.form.input-row-readonly type="text" name="updated_at" label="terakhir di edit"
                        :value="$user->updated_at" class="col" />
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="status" label="status"
                        :value="$user->status->name" class="col-md-4" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="level" label="level"
                        :value="$user->level->name" class="col-md-4" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection