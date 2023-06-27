@extends('private.templates.layout')

@section('header')
    level
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.management.user.level.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    @can('developer')
        <x-button-link href="{{ route(Request::segment(1) . '.management.user.level.trash.index') }}"
            label="sampah ({{ $count }})" class="float-end" icon="fa-fw fas fa-trash" />
    @endcan

    <x-alert-dismissing />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <form action="{{ route(Request::segment(1) . '.management.user.level.index') }}" method="get">
                            @csrf
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
                                        <th>warna</th>
                                        <th>&nbsp;</th>
                                        <th width="250">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($levels as $key=>$level)
                                        <tr>
                                            <td>{{ $levels->firstItem() + $key }}</td>
                                            <td>{{ $level->name }}</td>
                                            <td>
                                                <x-badge class="rounded-pill bg-{{ $level->color }}"
                                                    label="{{ $level->color }}" />
                                            </td>
                                            <td class="text-end">
                                                <x-field-date :create="$level->created_at" :update="$level->updated_at" class="text-secondary" />
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.management.user.level.show', $level->uuid) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.management.user.level.edit', $level->uuid) }}"
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.management.user.level.delete', $level->uuid) }}"
                                                    confirm="{{ $level->name }}" label="hapus"
                                                    class="rounded-pill btn btn-sm btn-outline-danger"
                                                    icon="fa-fw fas fa-trash" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
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
            <x-pagination :pages="$levels" side="1" />
        </div>
    </div>
@endsection
