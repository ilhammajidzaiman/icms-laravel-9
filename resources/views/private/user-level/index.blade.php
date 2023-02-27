@extends('private.templates.main')
@section('container')

<x-button-link-pill :href="$segmentHref.'/create'" label="baru" class="btn-sm btn-outline-secondary mb-3"
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
                                <x-badge-pill :class="$level->color" :label="$level->color" />
                            </td>
                            <td class="text-right text-secondary">
                                {{ $level->created_at->format('d-m-Y, H:i:s').', '.$level->created_at->diffForHumans()
                                }}
                            </td>
                            <td class="text-right">
                                <x-button-link-pill :href="$segmentHref.'/'.$level->slug" label="lihat"
                                    class="btn-xs btn-outline-primary" icon="fa-eye" />
                                <x-button-link-pill :href="$segmentHref.'/'.$level->slug.'/edit'" label="edit"
                                    class="btn-xs btn-outline-success" icon="fa-edit" />
                                <x-button-delete :href="$segmentHref.'/'.$level->slug" :confirm="$level->name" />
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