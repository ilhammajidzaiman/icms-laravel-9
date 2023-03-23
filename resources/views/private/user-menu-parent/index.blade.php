@extends('private.templates.main')
@section('container')

    <x-button-link :href="$segmentUrl . '/create'" label="baru" class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-plus" />
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
                            @forelse ($menus as $menu1)
                                @if (empty($menu1->url) || $menu1->url === '#')
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>
                                            <i class="text-primary expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            <span class="badge badge-secondary mr-2">{{ $menu1->order }}</span>
                                            <i class="{{ $menu1->icon }} mr-2"></i>
                                            {{ $menu1->name }}
                                            <span class="float-right">
                                                <x-button-link :href="$segmentUrl . '/' . $menu1->uuid . '/create-sub'" label="sub baru"
                                                    class="rounded-pill btn-xs btn-outline-secondary" icon="fa-plus" />
                                                <x-button-link :href="$segmentUrl . '/' . $menu1->uuid" label="lihat"
                                                    class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                                <x-button-link :href="$segmentUrl . '/' . $menu1->uuid . '/edit'" label="edit"
                                                    class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                                @php
                                                    $menu = App\Models\UserMenuChild::where('user_menu_parent_id', $menu1->id)->first();
                                                @endphp
                                            @empty($menu)
                                                <x-button-delete :href="$segmentUrl . '/' . $menu1->uuid" :confirm="$menu1->name" />
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
                                                        $menus2 = App\Models\UserMenuChild::where('user_menu_parent_id', $menu1->id)
                                                            ->orderBy('order')
                                                            ->get();
                                                    @endphp
                                                    @forelse ($menus2 as $menu2)
                                                        <tr class="table-secondary">
                                                            <td>
                                                                <i class="text-dark fas fa-caret-right fa-fw"></i>
                                                                <span
                                                                    class="badge badge-secondary mr-2">{{ $menu2->order }}</span>
                                                                <i class="{{ $menu2->icon }} mr-2"></i>
                                                                {{ $menu2->name }}
                                                                <span class="float-right">
                                                                    <x-button-link :href="$segmentUrl .
                                                                        '/' .
                                                                        $menu2->uuid .
                                                                        '/show-sub'" label="lihat"
                                                                        class="rounded-pill btn-xs btn-outline-primary"
                                                                        icon="fa-eye" />
                                                                    <x-button-link :href="$segmentUrl .
                                                                        '/' .
                                                                        $menu2->uuid .
                                                                        '/edit-sub'" label="edit"
                                                                        class="rounded-pill btn-xs btn-outline-success"
                                                                        icon="fa-edit" />
                                                                    <x-button-delete :href="$segmentUrl .
                                                                        '/' .
                                                                        $menu2->uuid .
                                                                        '/delete-sub'"
                                                                        :confirm="$menu2->name" />
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr class="table-secondary">
                                                            <td>
                                                                <x-alert-empty />
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
                                        <span class="badge badge-secondary mr-2">{{ $menu1->order }}</span>
                                        <i class="{{ $menu1->icon }} mr-2"></i>
                                        {{ $menu1->name }}
                                        <span class="float-right">
                                            <x-button-link :href="$segmentUrl . '/' . $menu1->uuid" label="lihat"
                                                class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                            <x-button-link :href="$segmentUrl . '/' . $menu1->uuid . '/edit'" label="edit"
                                                class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                            <x-button-delete :href="$segmentUrl . '/' . $menu1->uuid" :confirm="$menu1->name" />
                                        </span>
                                    </td>
                                </tr>
                            @endif

                        @empty
                            {{-- jika data kosong --}}
                            <tr>
                                <td>
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
@endsection
