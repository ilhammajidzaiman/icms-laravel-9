@extends('private.templates.layout')

@section('header')
    sampah
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.nav-menu.parent.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <x-alert-dismissing />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th>menu</th>
                                        <th width="250">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($navMenuParents as $navMenuParent)
                                        @php
                                            $hasParent = App\Models\NavMenu\navMenuParent::onlyTrashed()
                                                ->where('id', $navMenuParent->id)
                                                ->first();
                                            //
                                            $hasChild = App\Models\NavMenu\NavMenuChild::onlyTrashed()
                                                ->where('nav_menu_parent_id', $navMenuParent->id)
                                                ->first();
                                            //
                                            $navMenuChildren = App\Models\NavMenu\NavMenuChild::onlyTrashed()
                                                ->where('nav_menu_parent_id', $navMenuParent->id)
                                                ->orderBy('order')
                                                ->get();
                                        @endphp
                                        <tr>
                                            <td>
                                                <x-badge class="badge bg-primary me-3" label="{{ $navMenuParent->order }}" />
                                                {{ $navMenuParent->name }}
                                            </td>
                                            <td class="text-end">
                                                {{-- @if (empty($hasParent->url) || $hasParent->url === '#')
                                                    <x-button-link
                                                        href="{{ route(Request::segment(1) . '.nav-menu.child.create', $navMenuParent->uuid) }} "
                                                        label="sub baru"
                                                        class="rounded-pill btn btn-sm  btn-outline-secondary"
                                                        icon="fa-fw fas fa-plus" />
                                                @endif
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.show', $navMenuParent->uuid) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.edit', $navMenuParent->uuid) }} "
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" /> --}}
                                            @empty($hasChild)
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.trash.restore', $navMenuParent->uuid) }}"
                                                    label="pulihkan" class="rounded-pill btn btn-sm btn-outline-info"
                                                    icon="fa-fw fas fa-recycle" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.trash.delete', $navMenuParent->uuid) }}"
                                                    confirm="permanen {{ $navMenuParent->name }}" label="hapus"
                                                    class="rounded-pill btn btn-sm btn-outline-danger"
                                                    icon="fa-fw fas fa-trash" />
                                            @endempty
                                        </td>
                                    </tr>
                                    @if (empty($hasParent->url) || $hasParent->url === '#')
                                        @foreach ($navMenuChildren as $navMenuChild)
                                            <tr>
                                                <td>
                                                    <div class="ms-5">
                                                        <x-badge class="badge bg-secondary me-3"
                                                            label="{{ $navMenuChild->order }}" />
                                                        {{ $navMenuChild->name }}
                                                    </div>
                                                </td>
                                                <td class="text-end">

                                                    <x-button-link
                                                        href="{{ route(Request::segment(1) . '.nav-menu.child.trash.restore', $navMenuChild->uuid) }}"
                                                        label="pulihkan"
                                                        class="rounded-pill btn btn-sm btn-outline-info"
                                                        icon="fa-fw fas fa-recycle" />
                                                    <x-button-delete
                                                        href="{{ route(Request::segment(1) . '.nav-menu.child.trash.delete', $navMenuChild->uuid) }}"
                                                        confirm="permanen {{ $navMenuChild->name }}" label="hapus"
                                                        class="rounded-pill btn btn-sm btn-outline-danger"
                                                        icon="fa-fw fas fa-trash" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <x-alert-empty-icon label="Tidak ada sampah ditemukan..."
                                                icon="fa-fw fas fa-trash-alt fs-1" />
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
