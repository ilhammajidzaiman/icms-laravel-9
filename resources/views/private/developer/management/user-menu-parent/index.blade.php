@extends('private.templates.main')

@section('header')
    menu
@endsection

@section('container')

    <x-button-link href="{{ route('developer.management.user.menu.parent.create') }}" label="baru"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-plus" />
    <x-alert-dismissing />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-borderless text-nowrap">
                        <thead>
                            <tr class="text-capitalize">
                                <th scope="col">menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menuParents as $menuParent)
                                @if (empty($menuParent->url) || $menuParent->url === '#')
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>
                                            <i class="text-primary expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            <span class="badge badge-secondary mr-2">{{ $menuParent->order }}</span>
                                            <i class="{{ $menuParent->icon }} mr-2"></i>
                                            {{ $menuParent->name }}
                                            <span class="float-right">
                                                <x-button-link
                                                    href="{{ route('developer.management.user.menu.child.create', $menuParent->uuid) }} "
                                                    label="sub baru" class="rounded-pill btn-xs btn-outline-secondary"
                                                    icon="fa-plus" />
                                                <x-button-link
                                                    href="{{ route('developer.management.user.menu.parent.show', $menuParent->uuid) }}"
                                                    label="lihat" class="rounded-pill btn-xs btn-outline-primary"
                                                    icon="fa-eye" />
                                                <x-button-link
                                                    href="{{ route('developer.management.user.menu.parent.edit', $menuParent->uuid) }} "
                                                    label="edit" class="rounded-pill btn-xs btn-outline-success"
                                                    icon="fa-edit" />
                                                @php
                                                    $menu = App\Models\UserMenuChild::where('user_menu_parent_id', $menuParent->id)->first();
                                                @endphp
                                            @empty($menu)
                                                <x-button-delete
                                                    href="{{ route('developer.management.user.menu.parent.delete', $menuParent->uuid) }}"
                                                    :confirm="$menuParent->name" />
                                            @endempty
                                        </span>
                                    </td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td>
                                        <div class="p-0 pl-2" style="display: none;">
                                            <table class="table table-hover">
                                                <tbody>
                                                    @php
                                                        $menuChilds = App\Models\UserMenuChild::where('user_menu_parent_id', $menuParent->id)
                                                            ->orderBy('order')
                                                            ->get();
                                                    @endphp
                                                    @forelse ($menuChilds as $menuChild)
                                                        <tr class="table-secondary">
                                                            <td>
                                                                <i class="text-dark fas fa-caret-right fa-fw"></i>
                                                                <span
                                                                    class="badge badge-secondary mr-2">{{ $menuChild->order }}</span>
                                                                <i class="{{ $menuChild->icon }} mr-2"></i>
                                                                {{ $menuChild->name }}
                                                                <span class="float-right">
                                                                    <x-button-link
                                                                        href="{{ route('developer.management.user.menu.child.show', $menuChild->uuid) }}"
                                                                        label="lihat"
                                                                        class="rounded-pill btn-xs btn-outline-primary"
                                                                        icon="fa-eye" />
                                                                    <x-button-link
                                                                        href="{{ route('developer.management.user.menu.child.edit', $menuChild->uuid) }}"
                                                                        label="edit"
                                                                        class="rounded-pill btn-xs btn-outline-success"
                                                                        icon="fa-edit" />
                                                                    <x-button-delete
                                                                        href="{{ route('developer.management.user.menu.child.delete', $menuChild->uuid) }}"
                                                                        :confirm="$menuChild->name" />
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr class="table-secondary">
                                                            <td>
                                                                <x-alert-empty label="Belum ada data..." />
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="border-0">
                                        <i class="text-dark fas fa-caret-right fa-fw"></i>
                                        <span class="badge badge-secondary mr-2">{{ $menuParent->order }}</span>
                                        <i class="{{ $menuParent->icon }} mr-2"></i>
                                        {{ $menuParent->name }}
                                        <span class="float-right">
                                            <x-button-link
                                                href="{{ route('developer.management.user.menu.parent.show', $menuParent->uuid) }}"
                                                label="lihat" class="rounded-pill btn-xs btn-outline-primary"
                                                icon="fa-eye" />
                                            <x-button-link
                                                href="{{ route('developer.management.user.menu.parent.edit', $menuParent->uuid) }}"
                                                label="edit" class="rounded-pill btn-xs btn-outline-success"
                                                icon="fa-edit" />
                                            <x-button-delete
                                                href="{{ route('developer.management.user.menu.parent.delete', $menuParent->uuid) }}"
                                                :confirm="$menuParent->name" />
                                        </span>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td>
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
@endsection
