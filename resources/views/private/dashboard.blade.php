<x-app-layout>
    <x-slot name="breadcrumb">
        <x-breadcrumb>
            <x-breadcrumb.item :value="__('dashboard')" />
        </x-breadcrumb>
    </x-slot>

    <x-slot name="header">
        {{ __('dashboard') }}
    </x-slot>

    <x-card class="bg-light">
        <x-card.body class="border border-primary-subtle rounded-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="{{ asset('image/laravel.svg') }}" height="50">
                </div>
                <div class="flex-grow mx-3">
                    <h6 class="card-title">
                        Hai {{ Auth::user()->name ?? 'User' }}.
                    </h6>
                    <p class="card-text">
                        Selamat datang di aplikasi {{ env('APP_NAME') }}.
                    </p>
                </div>
                <div class="flex-grow ms-auto d-none d-sm-block">
                    <form action="{{ route('logout') }}" method="post" class="float-end">
                        @csrf
                        <x-link.button href="{{ route('logout') }}" value="{{ __('keluar') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            icon="bi bi-box-arrow-right" class="btn-primary d-inline" />
                    </form>
                </div>
            </div>
        </x-card.body>
    </x-card>
    <div class="row g-4 mt-0">
        <div class="col-md-3">
            <x-card class="bg-light">
                <x-card.body class="border border-primary-subtle rounded-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" height="50" fill="currentColor"
                                class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path
                                    d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                        </div>
                        <div class="flex-grow mx-3">
                            <h5 class="card-title">
                                {{ $countArticle->value }}
                            </h5>
                            <p class="card-text">
                                {{ Str::ucfirst(__($countArticle->label)) }}
                            </p>
                        </div>
                    </div>
                </x-card.body>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card class="bg-light">
                <x-card.body class="border border-primary-subtle rounded-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" height="50" fill="currentColor"
                                class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path
                                    d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                        </div>
                        <div class="flex-grow mx-3">
                            <h5 class="card-title">
                                {{ $countTag->value }}
                            </h5>
                            <p class="card-text">
                                {{ Str::ucfirst(__($countTag->label)) }}
                            </p>
                        </div>
                    </div>
                </x-card.body>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card class="bg-light">
                <x-card.body class="border border-primary-subtle rounded-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" height="50" fill="currentColor"
                                class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path
                                    d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                        </div>
                        <div class="flex-grow mx-3">
                            <h5 class="card-title">
                                {{ $countCategory->value }}
                            </h5>
                            <p class="card-text">
                                {{ Str::ucfirst(__($countCategory->label)) }}
                            </p>
                        </div>
                    </div>
                </x-card.body>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card class="bg-light">
                <x-card.body class="border border-primary-subtle rounded-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" height="50" fill="currentColor"
                                class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path
                                    d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                        </div>
                        <div class="flex-grow mx-3">
                            <h5 class="card-title">
                                {{ $countPage->value }}
                            </h5>
                            <p class="card-text">
                                {{ Str::ucfirst(__($countPage->label)) }}
                            </p>
                        </div>
                    </div>
                </x-card.body>
            </x-card>
        </div>
    </div>

</x-app-layout>
