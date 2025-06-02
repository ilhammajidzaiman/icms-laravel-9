<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @isset($header)
            {{ Str::ucfirst($header) . ' | ' . env('APP_NAME') }}
        @else
            {{ env('APP_NAME') }}
        @endisset
    </title>
    <link rel="shortcut icon" href="{{ asset('image/laravel.svg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
</head>

<body class="bg-body-tertiary">
    @include('layouts.navigation')

    <section class="container-fluid mt-5 pt-5">
        <!-- Breadcrumb -->
        @isset($breadcrumb)
            {{ $breadcrumb }}
        @endisset

        <!-- Heading -->
        <header class="row mb-3">
            <div class="col-sm-6">
                @isset($header)
                    <h3>
                        <a href="" class="text-decoration-none">
                            {{ Str::ucfirst($header) }}
                        </a>
                    </h3>
                @endisset
            </div>
            <div class="col-sm-6 text-capitalize">
                <div class="float-sm-end">
                    @isset($button)
                        {{ $button }}
                    @endisset
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="row">
            <div class="col">
                <x-card class="mb-3">
                    <x-card.body>
                        {{ $slot }}
                    </x-card.body>
                </x-card>
                <small class="py-3 text-secondary">
                    {{ env('APP_NAME') }}
                    &copy;
                    {{ date('Y') }}
                </small>
            </div>
        </main>
    </section>
    @stack('scripts')
</body>

</html>
