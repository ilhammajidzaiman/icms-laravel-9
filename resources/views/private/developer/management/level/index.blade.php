{{-- @extends('private.templates.layout')

@section('header')
    level
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.level.create') }}" label="baru"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-plus" />
    <x-alert-dismissing />

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap">
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
                                        <x-badge class="badge rounded-pill bg-{{ $level->color }}" :label="$level->color" />
                                    </td>
                                    <td class="text-right">
                                        <x-field-date :create="$level->created_at" :update="$level->updated_at" class="text-xs text-secondary" />
                                    </td>
                                    <td class="text-right">
                                        <x-button-link
                                            href="{{ route('developer.management.user.level.show', $level->slug) }}"
                                            label="lihat" class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link
                                            href="{{ route('developer.management.user.level.edit', $level->slug) }}"
                                            label="edit" class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                        <x-button-delete
                                            href="{{ route('developer.management.user.level.delete', $level->slug) }}"
                                            :confirm="$level->name" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <x-alert-empty label="Belum ada data..." />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('private.templates.layout')

@section('header')
    level
@endsection

@section('container')
    <x-alert-dismissing />

    <x-button-link href="{{ route('developer.management.user.level.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
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
                                    @forelse ($levels as $level)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $level->name }}</td>
                                            <td>
                                                <x-badge class="badge rounded-pill bg-{{ $level->color }}"
                                                    label="{{ $level->color }}" />
                                            </td>
                                            <td class="text-end">
                                                <x-field-date :create="$level->created_at" :update="$level->updated_at" class="text-secondary" />
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route('developer.management.user.level.show', $level->slug) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route('developer.management.user.level.edit', $level->slug) }}"
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route('developer.management.user.level.delete', $level->slug) }}"
                                                    confirm="{{ $level->name }}"
                                                    class="rounded-pill btn btn-sm btn-outline-danger" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
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
        </div>
    </div>
@endsection
