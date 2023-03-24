@extends('private.templates.main')
@section('container')
    <x-button-link :href="'./'" label="kembali" class="rounded-pill btn-sm btn-outline-secondary mb-3"
        icon="fa-arrow-left" />

    <div class="row">
        <div class="col-md-3 p-5">
            @php
                $file = $user->file;
                $path = $user->path;
                $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
            @endphp
            <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100 mb-3 mb-4">
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="name" label="nama" :value="$user->name"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="username" label="username" :value="$user->username"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="email" label="email" :value="$user->email"
                            class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="created_at" label="dibuat" :value="$user->created_at->diffForHumans() .
                            ', ' .
                            $user->created_at->format('d-m-Y, H:i:s')"
                            class="col" />
                        <x-form-input-row-readonly type="text" name="updated_at" label="diubah" :value="$user->updated_at->diffForHumans() .
                            ', ' .
                            $user->updated_at->format('d-m-Y, H:i:s')"
                            class="col" />
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="status" label="status" :value="$user->status->name"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="level" label="level" :value="$user->level->name"
                            class="col-md-4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
