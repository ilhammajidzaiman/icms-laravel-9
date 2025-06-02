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
        {{ $page->heading ?? null }}
    </x-slot>

    <x-slot name="button">
        <x-link href="{{ route($page->route . '.edit', ['id' => $record->uuid]) }}" value="{{ __('edit') }}"
            icon="bi bi-pencil-square" class="rounded-pill btn btn-success text-capitalize" />
    </x-slot>

    <h5 class="card-title">Judul: {{ $record->title ?? null }}</h5>
    <h5 class="card-title">Dibuat pada: {{ $record->created_at->translatedFormat('l, j F Y H:i') ?? now() }}</h5>
</x-app-layout>
