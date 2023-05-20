@extends('private.templates.main')
@section('container')
    <x-button-link :href="'./'" label="kembali" class="rounded-pill btn-sm btn-outline-secondary mb-3"
        icon="fa-arrow-left" />

    <div class="row">
        <div class="col-md-9 col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="name" label="nama" :value="$category->name"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="created_at" label="dibuat" :value="$category->created_at->diffForHumans() .
                            ', ' .
                            $category->created_at->format('d-m-Y, H:i:s')"
                            class="col" />
                        <x-form-input-row-readonly type="text" name="updated_at" label="diubah" :value="$category->updated_at->diffForHumans() .
                            ', ' .
                            $category->updated_at->format('d-m-Y, H:i:s')"
                            class="col" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
