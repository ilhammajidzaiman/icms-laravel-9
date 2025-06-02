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
            icon="bi bi-pencil-square" class="btn btn-success text-capitalize" />
    </x-slot>
    <div class="row g-4">
        <div class="col-md-3">
            <img src="{{ $record->profile?->file ? Storage::url($record->profile?->file) : asset('image/default.svg') }}"
                alt="image" class="rounded-3 w-100 object-fit-cover">
        </div>
        <div class="col-md-9">
            <h3>
                {{ __('Nama:') }}
                {{ $record->name ?? null }}
            </h3>
            <h3>
                {{ __('Tanggal lahir:') }}
                {{ \Carbon\Carbon::parse($record->profile?->birth_date)->translatedFormat('j-F-Y') ?? null }}
            </h3>
            <h3>
                {{ __('Jenis kelamin:') }}
                {{ $record->profile?->gender ? App\Enums\GenderEnum::from($record->profile?->gender)->label() : null }}
            </h3>
            <h3>
                {{ __('Username:') }}
                {{ $record->username ?? null }}
            </h3>
            <h3>
                {{ __('Email:') }}
                {{ $record->email ?? null }}
            </h3>
            <h6 class="test-secondary">
                {{ \Carbon\Carbon::parse($record->created_at)->translatedFormat('l, j F Y') ?? null }}
            </h6>
        </div>
    </div>
</x-app-layout>
