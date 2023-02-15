@extends('private.templates.main')
@section('container')
<x-private.button.link-create :href="$segmentHref" />
<x-private.alert.dismissing />

<form action="{{ $segmentForm }}" method="get">
    <div class="row">
        <x-private.search name="search" id="search" :value="request('search')" class="col-md-4" />
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
                            <th scope="col">&nbsp;</th>
                            <th scope="col" width="250">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td class="text-capitalize">{{ $user->name }}</td>
                            <td class="text-right text-secondary">
                                {{ $user->created_at->format('d-m-Y, H:i:s').', '.$user->created_at->diffForHumans() }}
                            </td>
                            <td class="text-right">
                                <x-private.button.link-read :href="$segmentHref.'/'.$user->uuid" />
                                <x-private.button.link-update :href="$segmentHref.'/'.$user->uuid" />
                                @if (auth()->user()->id==$user->id)
                                <x-private.button.button-delete-disabled />
                                @else
                                <x-private.button.button-delete :href="$segmentHref.'/'.$user->uuid"
                                    :confirm="$user->nama" />
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <x-private.alert.alert-empty />
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <x-private.pagination :pages="$users" side="1" />
    </div>
</div>

@endsection