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
        <div class="col-md-4">
            <img src="{{ $record->file ? Storage::url($record->file) : asset('image/default.svg') }}" alt="image"
                class="rounded-3 w-100 mb-3">
            @if (is_array($record->attachment) && count($record->attachment) > 0)
                <div class="attachment">
                    <div class="row g-4">
                        @foreach ($record->attachment as $attachment)
                            <div class="col-md-6">
                                @php
                                    $path = storage_path('app/public/' . $attachment);
                                    $isImage = @getimagesize($path) !== false;
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/' . $attachment) }}" alt="Attachment"
                                        class="rounded-3 w-100 h-100 object-fit-cover">
                                @else
                                    <a href="{{ asset('storage/' . $attachment) }}" target="_blank">
                                        {{ $attachment }}
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
        <div class="col-md-8">

            <h5 class="badge bg-primary">
                {{ $record->category?->title ?? '-' }}
            </h5>

            <h3>{{ $record->title ?? null }}</h3>

            <h6 class="test-secondary">
                {{ \Carbon\Carbon::parse($record->published_at)->translatedFormat('l, j F Y') ?? null }}
            </h6>
            <h6 class="test-secondary">
                Read time:
                {{ App\Helpers\EstimateReadingTime($record->content ?? null) }}
                menit
            </h6>
            <h6 class="test-secondary">
                {{ $record->visitor ?? null }}x Dilihat
            </h6>

            <div class="card-content">{!! $record->content ?? null !!}</div>


            @if ($record->tags)
                <p class="text-secondary">
                    Tag:
                </p>
                <div class="mb-5">
                    @foreach ($record->tags as $item)
                        <span class="fs-5">
                            <div class="badge bg-secondary-subtle text-secondary-emphasis fw-normal px-3 py-2">
                                {{ $item->title ?? null }}
                            </div>
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
