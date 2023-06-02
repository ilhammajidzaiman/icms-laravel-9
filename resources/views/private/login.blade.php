<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/' . config('app.icon')) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/pages/auth.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/plugins/mazer/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('auth.login') }}" class="text-reset">
                            <img src="{{ asset('assets/images/' . config('app.logo')) }}" alt="Logo">
                            <div class="fs-3">
                                {{ config('app.name') }}
                            </div>
                        </a>
                    </div>
                    <h1 class="auth-title fs-1">Log in.</h1>

                    <x-alert-dismissing />

                    <form action="{{ route('auth.login') }}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" name="email" id="email" value="{{ old('email') }}"
                                class="form-control form-control-lg @error('email')is-invalid @enderror"
                                placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <input type="password" name="password" id="password" value="{{ old('password') }}"
                                class="form-control form-control-lg @error('password')is-invalid @enderror"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-44">
                        <p class="text-gray-600">
                            <?= date('Y') ?> &copy;
                            {{ config('app.name') }}
                        </p>
                        <p>
                            Copyright
                            <a href="{{ route('/') }}" class="font-bold">
                                {{ config('app.copyright') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/plugins/mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/plugins/mazer/assets/js/app.js') }}"></script>
</body>

</html>
