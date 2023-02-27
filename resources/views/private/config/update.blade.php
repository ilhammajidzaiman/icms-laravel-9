@extends('private.templates.main')
@section('container')
<x-button-link-pill :href="'./'" label="kembali" class="btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

<form action="{{ $segmentForm }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-3 p-5">
            @php
            $value=$config->file;
            $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
            @endphp
            <x-form-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row type="text" name="app" label="app" :value="old('name',$config->app)"
                            class="col" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="detail" label="detail"
                            :value="old('detail',$config->detail)" class="col" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="copyright" label="copyright"
                            :value="old('copyright',$config->copyright)" class="col" />
                    </div>
                    <x-button-submit label="simpan" class="btn-primary" icon="fa-save" />
                </div>
            </div>
        </div>
    </div>
</form>
@endsection