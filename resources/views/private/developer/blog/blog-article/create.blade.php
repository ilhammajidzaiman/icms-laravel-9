@extends('private.templates.main')
@section('container')
    <x-button-link :href="'./'" label="kembali" class="rounded-pill btn-sm btn-outline-secondary mb-3"
        icon="fa-arrow-left" />

    <form action="{{ $segmentUrl }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="form-row">
                    <x-form-input-textarea rows="2" name="title" label="judul" :value="old('title')" class="col-12" />
                </div>
                <x-form-input-summernote name="content" label="content" :value="old('content')" />
            </div>
            <div class="col-md-3">
                @php
                    $url = url('assets/images/default-img.svg');
                @endphp
                <x-form-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
                <div class="card">
                    <div class="card-body">
                        <label>Kategori</label>
                        @foreach ($categories as $category)
                            <x-form-input-checkbox name="category[]" id="category{{ $category->id }}"
                                value="{{ $category->id }}" checked="">
                                <label class="form-check-label"
                                    for="category{{ $category->id }}">{{ $category->name }}</label>
                            </x-form-input-checkbox>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <x-form-input-select name="status" label="status" class="col-12">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" @selected(old('status') == $status->id)>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </x-form-input-select>
                </div>
                <x-button-submit label="simpan" class="rounded-pill btn-primary mb-3" icon="fa-save" />
            </div>
        </div>
    </form>
@endsection
