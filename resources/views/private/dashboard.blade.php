@extends('private.templates.main')
@section('container')
<div class="row">
    <div class="col">
        <div class="text-center my-5 py-5">
            <img src="{{ url('assets/images/'.config('app.logo')) }}" alt="{{ config('app.logo') }}" class="mb-5"
                width="128">
            <h3>Hai {{ auth()->user()->name }}!</h3>
            <h1>Selamat Datang di {{ config('app.name') }}</h1>
            <h5>{{ config('app.description') }}</h5>
        </div>
    </div>
</div>
@endsection