<x-guest-layout>
    <div class="text-center">
        <img src="{{ asset('image/laravel.svg') }}" alt="logo" height="70" class="mb-4">
        <h3 class="h3 mb-3 fw-normal">Silahkan registrasi akun anda untuk login</h3>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <x-form.input>
            <x-form.input.label for="name" :value="__('nama')" />
            <x-form.input.text type="text" name="name" id="name" :value="old('name')" />
            <x-form.input.error name="name" />
        </x-form.input>

        <!-- Email Address -->
        <x-form.input>
            <x-form.input.label for="email" :value="__('email')" />
            <x-form.input.text type="email" name="email" id="email" :value="old('email')" />
            <x-form.input.error name="email" />
        </x-form.input>

        <!-- Password -->
        <x-form.input>
            <x-form.input.label for="password" :value="__('password')" />
            <x-form.input.text type="password" name="password" id="password" />
            <x-form.input.error name="password" />
        </x-form.input>

        <!-- Confirm Password -->
        <x-form.input>
            <x-form.input.label for="password_confirmation" :value="__('konfirmasi password')" />
            <x-form.input.text type="password" name="password_confirmation" id="password_confirmation" />
            <x-form.input.error name="password_confirmation" />
        </x-form.input>

        <div class="d-grid">
            <button type="submit" class="rounded-pill btn btn-primary">
                <i class="bi bi-send"></i>
                {{ __('Daftar') }}
            </button>
        </div>

        <div class="mt-3">
            <x-link :href="route('login')" :value="__('Sudah terdaftar?')" />
        </div>
    </form>
</x-guest-layout>
