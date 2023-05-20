@extends('private.templates.main')

@section('header')
    rincian child menu
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.menu.parent.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <div class="row">
        <div class="col-md-9 col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="parent" label="parent menu" :value="$menuChild->parent->name"
                            class="col" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="order" label="urutan" :value="$menuChild->order"
                            class="col-md-2" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="name" label="nama" :value="$menuChild->name"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="icon" label="icon" :value="$menuChild->icon"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="prefix" label="prefix" :value="$menuChild->prefix"
                            class="col" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="url" label="url" :value="$menuChild->url"
                            class="col" />
                    </div>

                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="created_at" label="dibuat" :value="$menuChild->created_at->diffForHumans() .
                            ', ' .
                            $menuChild->created_at->format('d-m-Y, H:i:s')"
                            class="col" />
                        <x-form-input-row-readonly type="text" name="updated_at" label="diubah" :value="$menuChild->updated_at->diffForHumans() .
                            ', ' .
                            $menuChild->updated_at->format('d-m-Y, H:i:s')"
                            class="col" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
