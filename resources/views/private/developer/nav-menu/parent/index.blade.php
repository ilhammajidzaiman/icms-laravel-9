@extends('private.templates.layout')

@section('header')
    nav menu
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.nav-menu.parent.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

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
                                            $hasParent = App\Models\NavMenu\navMenuParent::where('id', $navMenuParent->id)->first();
                                            //
                                            $hasChild = App\Models\NavMenu\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)->first();
                                            //
                                            $navMenuChildren = App\Models\NavMenu\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)
                                                ->orderBy('order')
                                                ->get();
                                        @endphp
                                        <tr>
                                            <td>
                                                <x-badge class="badge bg-primary me-3" label="{{ $navMenuParent->order }}" />
                                                {{ $navMenuParent->name }}
                                            </td>
                                            <td class="text-end">
                                                @if (empty($hasParent->url) || $hasParent->url === '#')
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
                                                    icon="fa-fw fas fa-edit" />
                                            @empty($hasChild)
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.delete', $navMenuParent->uuid) }}"
                                                    confirm="{{ $navMenuParent->name }}"
                                                    class="rounded-pill btn btn-sm btn-outline-danger" />
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
                                                        href="{{ route(Request::segment(1) . '.nav-menu.child.show', $navMenuChild->uuid) }}"
                                                        label="lihat"
                                                        class="rounded-pill btn btn-sm btn-outline-primary"
                                                        icon="fa-fw fas fa-eye" />
                                                    <x-button-link
                                                        href="{{ route(Request::segment(1) . '.nav-menu.child.edit', $navMenuChild->uuid) }} "
                                                        label="edit"
                                                        class="rounded-pill btn btn-sm btn-outline-success"
                                                        icon="fa-fw fas fa-edit" />
                                                    <x-button-delete
                                                        href="{{ route(Request::segment(1) . '.nav-menu.child.delete', $navMenuChild->uuid) }}"
                                                        confirm="{{ $navMenuChild->name }}"
                                                        class="rounded-pill btn btn-sm btn-outline-danger" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="2">
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
    </div>
</div>
@endsection
