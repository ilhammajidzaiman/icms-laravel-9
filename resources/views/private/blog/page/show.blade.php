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
    <div class="row justify-content-between g-4">
        @if ($record->file)
            <div class="col-md-4">
                <img src="{{ $record->file ? Storage::url($record->file) : asset('image/default.svg') }}"
                    alt="image" class="rounded-3 w-100 mb-3">
            </div>
        @endif
        <div class="col-md-7">
            <h3>{{ $record->title ?? null }}</h3>

            <h6 class="test-secondary">
                {{ \Carbon\Carbon::parse($record->created_at)->translatedFormat('l, j F Y') }}
            </h6>
            <h6 class="test-secondary">
                Read time:
                {{ App\Helpers\EstimateReadingTime($record->content) }}
                menit
            </h6>
            <div class="card-content">{!! $record->content ?? null !!}</div>
        </div>
    </div>
</x-app-layout>
