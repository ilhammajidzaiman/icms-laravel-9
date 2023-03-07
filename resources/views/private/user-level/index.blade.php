@extends('private.templates.main')
@section('container')

<x-button-link :href="$segmentUrl.'/create'" label="baru" class="rounded-pill btn-sm btn-outline-secondary mb-3"
    icon="fa-plus" />
<x-alert-dismissing />

<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-capitalize">
                            <th scope="col">#</th>
                            <th scope="col">nama</th>
                            <th scope="col">warna</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col" width="250">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($levels as $level)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $level->name }}</td>
                            <td>
                                <x-badge class="badge-pill badge-{{ $level->color }}" :label="$level->color" />
                            </td>
                            <td class="text-right">
                                <x-field-date :create="$level->created_at" :update="$level->updated_at"
                                    class="text-xs text-secondary" />
                            </td>
                            <td class="text-right">
                                <x-button-link :href="$segmentUrl.'/'.$level->slug" label="lihat"
                                    class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                <x-button-link :href="$segmentUrl.'/'.$level->slug.'/edit'" label="edit"
                                    class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                <x-button-delete :href="$segmentUrl.'/'.$level->slug" :confirm="$level->name" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <x-alert-empty />
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection