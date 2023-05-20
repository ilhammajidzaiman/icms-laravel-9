@extends('private.templates.main')

@section('header')
    user
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.create') }}" label="baru"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-plus" />
    <x-alert-dismissing />

    <form action="{{ $segmentUrl }}" method="get">
        <div class="row">
            <x-search-input name="search" id="search" value="{{ request('search') }}" class="col-md-4" />
        </div>
    </form>

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap">
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
                                        <x-badge class="badge-pill badge-{{ $user->status->color }}"
                                            label="{{ $user->status->name }}" />
                                    </td>
                                    <td>
                                        <x-badge class="badge-pill badge-{{ $user->level->color }}"
                                            label="{{ $user->level->name }}" />
                                    </td>
                                    <td class="text-right">
                                        <x-field-date :create="$user->created_at" :update="$user->updated_at" class="text-xs text-secondary" />
                                    </td>
                                    <td class="text-right">
                                        <x-button-link href="{{ route('developer.management.user.show', $user->uuid) }}"
                                            label="lihat" class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link href="{{ route('developer.management.user.edit', $user->uuid) }}"
                                            label="edit" class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />

                                        @if (auth()->user()->id == $user->id)
                                            <x-button-disable label="hapus" class="rounded-pill btn-xs btn-outline-danger"
                                                icon="fa-trash" confirm="Maaf, Anda tidak punya akses!" />
                                        @else
                                            <x-button-delete
                                                href="{{ route('developer.management.user.delete', $user->uuid) }}"
                                                confirm="{{ $user->name }}" />
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <x-alert-empty label="Belum ada data..." />
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
