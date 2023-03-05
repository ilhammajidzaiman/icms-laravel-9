@extends('private.templates.main')
@section('container')
<x-button-link :href="$segmentUrl.'/edit'" label="edit" class="rounded-pill btn-sm btn-outline-success mb-3"
    icon="fa-edit" />
<x-alert-dismissing />

<div class="row">
    <div class="col-md-3 p-5">
        @php
        $value = $profil->file;
        $value == 'default-user.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
        @endphp
        <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100 mb-3 mb-4">
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h3 class="text-capitalize mb-4">profil</h3>
                <p><span class="font-weight-bold">Nama</span>: {{ $profil->name }}</p>
                <p><span class="font-weight-bold">username</span>: {{ $profil->username }}</p>
                <p><span class="font-weight-bold">email</span>: {{ $profil->email }}</p>
                <p><span class="font-weight-bold">status</span>: {{ $profil->status->name }}</p>
                <p><span class="font-weight-bold">level</span>: {{ $profil->level->name }}</p>
                <p><span class="font-weight-bold">dibuat</span>: {{ $profil->created_at }}</p>
                <p><span class="font-weight-bold">diubah</span>: {{ $profil->updated_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection