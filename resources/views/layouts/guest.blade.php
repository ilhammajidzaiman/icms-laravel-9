<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ Str::headline('Log in') . ' | ' . env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('image/laravel.svg') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <x-card class="p-3">
                    <x-card.body>
                        {{ $slot }}
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </section>
</body>

</html>
