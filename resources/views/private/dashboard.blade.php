@extends('private.templates.main')
@section('container')
<div class="row">
    <div class="col">
        <div class="text-center my-5 py-5">
            @php
            $value = $config->file;
            $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
            @endphp
            <img src="{{ $url }}" alt="{{ $url }}" class="mb-5" width="180">
            <h3>Hai {{ auth()->user()->name }}!</h3>
            <h1>Selamat Datang di {{ $config->app }}</h1>
            <h5>{{ $config->detail }}</h5>
        </div>
    </div>
</div>
@endsection