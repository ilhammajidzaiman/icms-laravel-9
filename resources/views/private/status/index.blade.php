@extends('private.templates.main')
@section('container')
<x-private.button.link-create :href="$segmentHref" />
<x-private.alert.dismissing />

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
                        @forelse ($statuses as $status)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $status->name }}</td>
                            <td class="text-right text-secondary">
                                {{ $status->created_at->format('D, d-m-Y, H:i:s') }}
                            </td>
                            <td class="text-right">
                                <x-private.button.link-read :href="$segmentHref.'/'.$status->slug" />
                                <x-private.button.link-update :href="$segmentHref.'/'.$status->slug" />
                                <x-private.button.button-delete :href="$segmentHref.'/'.$status->slug"
                                    :confirm="$status->name" />
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
    </div>
</div>
@endsection