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
                                        <tr>
                                            <td>
                                                <x-badge class="badge bg-primary me-3" label="{{ $navMenuParent->order }}" />
                                                {{ $navMenuParent->name }}
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.show', $navMenuParent->uuid) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.edit', $navMenuParent->uuid) }} "
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                @php
                                                    $menu = App\Models\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)->first();
                                                @endphp
                                            @empty($menu)
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.nav-menu.parent.delete', $navMenuParent->uuid) }}"
                                                    confirm="{{ $navMenuParent->name }}"
                                                    class="rounded-pill btn btn-sm btn-outline-danger" />
                                            @endempty
                                        </td>
                                    </tr>

                                    {{-- @php
                                        $menuChilds = App\Models\UserMenuChild::where('user_menu_parent_id', $navMenuParent->id)
                                            ->orderBy('order')
                                            ->get();
                                    @endphp
                                    @foreach ($menuChilds as $menuChild)
                                        <tr>
                                            <td>
                                                <div class="ms-5">
                                                    <x-badge class="badge bg-secondary me-3"
                                                        label="{{ $menuChild->order }}" />
                                                    <i class="{{ $menuChild->icon }}"></i>
                                                    {{ $menuChild->name }}
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.management.user.menu.child.show', $menuChild->uuid) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.management.user.menu.child.edit', $menuChild->uuid) }} "
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.management.user.menu.child.delete', $menuChild->uuid) }}"
                                                    confirm="{{ $menuChild->name }}"
                                                    class="rounded-pill btn btn-sm btn-outline-danger" />
                                            </td>
                                        </tr>
                                    @endforeach 
                                    --}}
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
