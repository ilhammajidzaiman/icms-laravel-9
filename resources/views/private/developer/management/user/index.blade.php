@extends('private.templates.layout')

@section('header')
    user
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.management.user.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    <x-alert-dismissing />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <form action="{{ route(Request::segment(1) . '.management.user.index') }}" method="get">
                            <div class="row justify-content-end">
                                <x-search-input name="search" id="search" value="{{ request('search') }}"
                                    class="col-md-4" />
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th>#</th>
                                        <th>nama</th>
                                        <th>status</th>
                                        <th>level</th>
                                        <th>&nbsp;</th>
                                        <th width="250">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key=>$user)
                                        <tr>
                                            <td>{{ $users->firstItem() + $key }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <x-badge class="rounded-pill bg-{{ $user->status->color }}"
                                                    label="{{ $user->status->name }}" />
                                            </td>
                                            <td>
                                                <x-badge class="rounded-pill bg-{{ $user->level->color }}"
                                                    label="{{ $user->level->name }}" />
                                            </td>
                                            <td class="text-end">
                                                <x-field-date :create="$user->created_at" :update="$user->updated_at" class="text-secondary" />
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.management.user.show', $user->uuid) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.management.user.edit', $user->uuid) }}"
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.management.user.delete', $user->uuid) }}"
                                                    confirm="{{ $user->name }}" label="hapus"
                                                    class="rounded-pill btn btn-sm btn-outline-danger"
                                                    icon="fa-fw fas fa-trash" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <x-alert-empty label="Data tidak ditemukan..." />
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-pagination :pages="$users" side="1" />
        </div>
    </div>
@endsection
