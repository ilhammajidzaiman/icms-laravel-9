@extends('private.templates.main')
@section('container')
<x-private.button.link-edit :href="$segmentHref" />
<x-private.alert.dismissing />

<div class="row mt-3">
    <div class="col-md-3 p-5">
        @php
        $value = $config->file;
        $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
        @endphp
        <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100 mb-3 mb-4">
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="app" label="app" :value="$config->app"
                        class="col" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="detail" label="detail" :value="$config->detail"
                        class="col" />
                </div>
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="copyright" label="copyright"
                        :value="$config->copyright" class="col" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection