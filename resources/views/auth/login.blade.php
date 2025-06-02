<x-guest-layout>
    <div class="text-center">
        <img src="{{ asset('image/laravel.svg') }}" alt="logo" height="70" class="mb-4">
        <h3 class="h3 mb-3 fw-normal">Silahkan masuk</h3>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email/Username -->
        <x-form.input>
            <x-form.input.label for="email" :value="__('Email/Username')" />
            <x-form.input.text type="text" name="email" id="email" :value="old('email')" />
            <x-form.input.error name="email" />
        </x-form.input>

        <!-- Password -->
        <x-form.input>
            <x-form.input.label for="password" :value="__('Password')" />
            <x-form.input.text type="password" name="password" id="password" />
            <x-form.input.error name="password" />
        </x-form.input>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
            <label for="remember_me" class="form-check-label">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="d-grid">
            <button type="submit" class="rounded-pill btn btn-primary">
                <i class="bi bi-box-arrow-in-right"></i>
                {{ __('Log in') }}
            </button>
        </div>
        @if (Route::has('password.request'))
            <div class="mt-3">
                <x-link :href="route('password.request')" :value="__('Lupa password?')" />
            </div>
        @endif
    </form>
</x-guest-layout>
