@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="../" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ $segmentForm.'/'.$status->slug }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="name" label="nama"
                            :value="old('name',$status->name)" class="col-md-4" />
                    </div>
                    <x-private.button.button-save />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection