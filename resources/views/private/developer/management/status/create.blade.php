@extends('private.templates.layout')

@section('header')
    status
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.status.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('developer.management.user.status.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <x-form-input-row type="text" name="name" label="nama" value="{{ old('name') }}"
                                    class="col-md-4" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="color" label="warna" value="{{ old('color') }}"
                                    class="col-md-4" />
                            </div>
                            <x-button-submit label="simpan" class="btn btn-primary" icon="fa-fw fas fa-save" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
