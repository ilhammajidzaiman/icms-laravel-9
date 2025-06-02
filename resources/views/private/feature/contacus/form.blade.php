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

    <x-form action="{{ route($page->route . '.' . $page->routeName, ['id' => $record->uuid]) }}" method="post">
        @method($page->method ?? null)
        @csrf
        <div class="row">
            <div class="col">
                <x-form.input>
                    <x-form.input.label for="title" value="{{ __('judul') }}" />
                    <x-form.input.text type="text" name="title" id="title"
                        value="{{ old('title', $record->title) }}" />
                    <x-form.input.error name="title" />
                </x-form.input>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-link.button href="{{ route($page->route . '.index') }}" value="{{ __('kembali') }}"
                    icon="bi bi-arrow-left" class="btn-secondary me-2" />
                <x-button type="submit" value="{{ __('kirim') }}" icon="bi bi-send" />
            </div>
        </div>
    </x-form>
</x-app-layout>
