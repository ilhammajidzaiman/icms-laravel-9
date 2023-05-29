@extends('private.templates.layout')

@section('header')
    dashboard
@endsection

@section('container')
    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="text-center my-2 py-5">
                            <img src="{{ url('assets/images/' . config('app.logo')) }}" alt="{{ config('app.logo') }}"
                                class="mb-5" width="128">
                            <h3>Hai {{ auth()->user()->name }}!</h3>
                            <h1>Selamat Datang di {{ config('app.name') }}</h1>
                            <h6>{{ config('app.description') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
