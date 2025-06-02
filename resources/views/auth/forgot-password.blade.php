<x-guest-layout>
    <div class="text-center">
        <img src="{{ asset('image/laravel.svg') }}" alt="logo" height="70" class="mb-4">
        <p class="mb-3 card-text">
            Lupa kata sandi Anda? Tidak masalah. Kami akan mengirimkan email berisi tautan pengaturan ulang kata sandi
            anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <x-form.input>
            <x-form.input.label for="email" :value="__('email')" />
            <x-form.input.text type="email" name="email" id="email" :value="old('email')" />
            <x-form.input.error name="email" />
        </x-form.input>
        <div class="d-grid">
            <button type="submit" class="rounded-pill btn btn-primary">
                <i class="bi bi-send"></i>
                {{ __('Password Reset') }}
            </button>
        </div>

        <div class="mt-3">
            <x-link :href="route('login')" :value="__('Kembali login?')" />
        </div>
    </form>
</x-guest-layout>
