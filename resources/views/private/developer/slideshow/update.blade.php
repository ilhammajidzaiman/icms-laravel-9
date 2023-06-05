@extends('private.templates.layout')

@section('header')
    edit slideshow
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.slideshow.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />


    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route(Request::segment(1) . '.slideshow.update', $slideshow->uuid) }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group text-capitalize">
                                    @php
                                        $path = $slideshow->path;
                                        $file = $slideshow->file;
                                        $file == 'default-slideshow.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                    @endphp
                                    <img src="{{ $url }}" alt="{{ $url }}"
                                        class="img-fluid rounded w-100 mb-3 img-preview">
                                    <label for="file" class="form-label">thumbnail</label>
                                    <input type="file" name="file" id="file" class="form-control"
                                        accept=".jpg,.jpeg,.png" onchange="previewImg()">
                                </div>
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="title" label="judul"
                                    value="{{ old('title', $slideshow->title) }}" class="col" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="detail" label="rincian"
                                    value="{{ old('detail', $slideshow->detail) }}" class="col" />
                            </div>
                            <div class="row">
                                <x-form-input-select name="status" label="status" class="col-12 col-md-3">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" @selected(old('status', $slideshow->status_id) == $status->id)>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </x-form-input-select>
                            </div>
                            <x-button-submit label="simpan" class="btn btn-primary" icon="fa-fw fas fa-save" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewImg() {
            const cover = document.querySelector('#file');
            const imgPreview = document.querySelector('.img-preview');
            const fileCover = new FileReader();
            fileCover.readAsDataURL(cover.files[0]);
            fileCover.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
@endsection
