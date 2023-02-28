@extends('private.templates.main')
@section('container')

<x-button-link-pill :href="$segmentHref.'/create'" label="baru" class="btn-sm btn-outline-secondary mb-3"
    icon="fa-plus" />
<x-alert-dismissing />

<form action="{{ $segmentForm }}" method="get">
    <div class="row">
        <x-search-input name="search" id="search" :value="request('search')" class="col-md-4" />
    </div>
</form>

<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-capitalize">
                            <th scope="col">#</th>
                            <th scope="col">nama</th>
                            <th scope="col">status</th>
                            <th scope="col">level</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col" width="250">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td class="text-capitalize">{{ $user->name }}</td>
                            <td>
                                <x-badge-pill :class="$user->status->color" :label="$user->status->name" />
                            </td>
                            <td>
                                <x-badge-pill :class="$user->level->color" :label="$user->level->name" />
                            </td>
                            <td class="text-right text-secondary">
                                {{ $user->created_at->format('d-m-Y, H:i:s').', '.$user->created_at->diffForHumans() }}
                            </td>
                            <td class="text-right">

                                <x-button-link-pill :href="$segmentHref.'/'.$user->uuid" label="lihat"
                                    class="btn-xs btn-outline-primary" icon="fa-eye" />
                                <x-button-link-pill :href="$segmentHref.'/'.$user->uuid.'/edit'" label="edit"
                                    class="btn-xs btn-outline-success" icon="fa-edit" />
                                @if (auth()->user()->id==$user->id)
                                <x-button-delete-disable />
                                @else
                                <x-button-delete :href="$segmentHref.'/'.$user->uuid" :confirm="$user->name" />
                                @endif
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
        <x-pagination :pages="$users" side="1" />
    </div>
</div>

@endsection