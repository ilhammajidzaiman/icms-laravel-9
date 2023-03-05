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
                        @forelse ($statuses as $status)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $status->name }}</td>
                            <td>
                                <x-badge class="badge-pill badge-{{ $status->color }}" :label="$status->color" />
                            </td>
                            <td class="text-right text-secondary">
                                {{ $status->created_at->format('d-m-Y, H:i:s').', '.$status->created_at->diffForHumans()
                                }}
                            </td>
                            <td class="text-right">
                                <x-button-link :href="$segmentUrl.'/'.$status->slug" label="lihat"
                                    class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                <x-button-link :href="$segmentUrl.'/'.$status->slug.'/edit'" label="edit"
                                    class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                <x-button-delete :href="$segmentUrl.'/'.$status->slug" :confirm="$status->name" />
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