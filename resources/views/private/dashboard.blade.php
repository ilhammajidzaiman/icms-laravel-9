@extends('private.templates.layout')
@section('header')
    dashboard
@endsection
@section('container')
    <div class="card">
        {{-- <div class="card-header">
            <h4 class="card-title">Example Content</h4>
        </div> --}}
        <div class="card-body">
            <div class="text-center my-5 py-5">
                <img src="{{ url('assets/images/' . config('app.logo')) }}" alt="{{ config('app.logo') }}" class="mb-5"
                    width="128">
                <h3>Hai {{ auth()->user()->name }}!</h3>
                <h1>Selamat Datang di {{ config('app.name') }}</h1>
                <h5>{{ config('app.description') }}</h5>
            </div>
        </div>
    </div>
@endsection
