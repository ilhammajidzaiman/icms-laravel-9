@extends('private.templates.main')
@section('container')
<x-button-link-pill :href="$segmentForm.'edit'" label="edit" class="btn-sm btn-outline-success mb-3" icon="fa-edit" />
<x-alert-dismissing />


<div class="row">
    <div class="col-md-3 p-5">
        @php
        $value = $config->file;
        $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
        @endphp
        <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100">
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="app" label="app" :value="$config->app" class="col" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="detail" label="detail" :value="$config->detail"
                        class="col" />
                </div>
                <div class="form-row">
                    <x-form-input-row-readonly type="text" name="copyright" label="copyright"
                        :value="$config->copyright" class="col" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection