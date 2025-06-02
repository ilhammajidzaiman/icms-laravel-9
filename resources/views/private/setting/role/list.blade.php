<x-app-layout>
    <x-slot name="breadcrumb">
        <x-breadcrumb>
            <x-breadcrumb.item href="{{ route('dashboard') }}" value="{{ __('dashboard') }}" />
            <x-breadcrumb.item href="{{ route($page->route . '.index') }}" value="{{ $page->title ?? null }}" />
            <x-breadcrumb.item value="{{ $page->label ?? null }}" />
        </x-breadcrumb>
    </x-slot>

    <x-slot name="header">
        {{ $page->label ?? null }}
        {{ $page->title ?? null }}
    </x-slot>

    <x-slot name="button">
        @if ($page->routeName !== 'trash')
            <x-link.button href="{{ route($page->route . '.create') }}" value="{{ __('baru') }}" icon="bi bi-plus-lg"
                class="btn-primary" />
            <x-link.button href="{{ route($page->route . '.trash') }}" value="{{ __('sampah') }}" icon="bi bi-trash2"
                class="btn-secondary" />
        @else
            <x-link href="{{ route($page->route . '.index') }}" value="{{ __('kembali') }}" icon="bi bi-arrow-left"
                class="btn btn-secondary" />
        @endif
    </x-slot>

    <form action="{{ route($page->route . '.index') }}" method="get" class="mb-3">
        @method('get')
        @csrf
        <div class="d-flex flex-wrap justify-content-end">
            <div class="mb-3 mx-1">
                <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                    class="form-control">
            </div>
            <div class="mb-3 mx-1">
                <input type="date" name="start_date" placeholder="Mulai..." value="{{ request('start_date') }}"
                    class="form-control">
            </div>
            <div class="mb-3 mx-1">
                <input type="date" name="end_date" placeholder="Hingga..." value="{{ request('end_date') }}"
                    class="form-control">
            </div>
            <div class="mb-3 mx-1 ">
                <button class="btn btn-primary px-3" type="submit">
                    <i class="bi bi-search"></i>
                    {{ __('cari') }}
                </button>
            </div>
        </div>
    </form>

    @if ($record->isEmpty())
        <h5 class="text-center">
            <i class="bi bi-folder-x fs-1"></i>
            <p>{{ __('tidak ditemukan.') }}</p>
        </h5>
    @else
        <x-table class="mb-3">
            <x-table.thead>
                <x-table.tr>
                    <x-table.th>#</x-table.th>
                    <x-table.th>{{ __('nama') }}</x-table.th>
                    <x-table.th width="300">&nbsp;</x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($record as $key => $item)
                    <x-table.tr>
                        <x-table.th>{{ $record->firstItem() + $key }}</x-table.th>
                        <x-table.td>{{ $item->name }}</x-table.td>
                        <x-table.td>
                            @if ($page->routeName !== 'trash')
                                <x-link.button href="{{ route($page->route . '.show', ['id' => $item->id]) }}"
                                    value="{{ __('lihat') }}" icon="bi bi-eye" class="btn-outline-primary btn-sm" />
                                <x-link.button href="{{ route($page->route . '.edit', ['id' => $item->id]) }}"
                                    value="{{ __('ubah') }}" icon="bi bi-pencil-square"
                                    class="btn-outline-success btn-sm" />
                                <x-link.button href="{{ route($page->route . '.delete', ['id' => $item->id]) }}"
                                    value="{{ __('hapus') }}" icon="bi bi-trash2" data-confirm-delete="true"
                                    class="btn-outline-danger btn-sm" />
                            @else
                                <x-link.button href="{{ route($page->route . '.show', ['id' => $item->id]) }}"
                                    value="{{ __('lihat') }}" icon="bi bi-eye" class="btn-outline-primary btn-sm" />
                                <x-link.button href="{{ route($page->route . '.restore', ['id' => $item->id]) }}"
                                    value="{{ __('pulihkan') }}" icon="bi bi-arrow-clockwise"
                                    class="btn-outline-success btn-sm" />
                                <x-link.button href="{{ route($page->route . '.forceDelete', ['id' => $item->id]) }}"
                                    value="{{ __('hapus') }}" icon="bi bi-trash2" data-confirm-delete="true"
                                    class="btn-outline-danger btn-sm" />
                            @endif
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table>

        {{ $record->links() }}
    @endif
    @push('scripts')
        @include('sweetalert::alert')
    @endpush
</x-app-layout>
