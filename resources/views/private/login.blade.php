<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $config->app }}</title>
    @php
    $value = $config->file;
    $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
    @endphp
    <link rel="shortcut icon" href="{{ $url }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/admin-lte-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/admin-lte-3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/summernote-0.8.18-dist/summernote-bs4.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">
                <div>
                    <img src="{{ $url }}" alt="{{ $url }}" class="brand-image img-circlee elevation-22" width="86"
                        height="86">
                </div>
                {{ $config->app }}
            </a>
        </div>

        <div class="card">
            <div class="card-body login-card-bodyy">
                <p class="login-box-msg">Silahkan login</p>
                <x-alert-dismissing />
                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <x-form-input-login type="text" name="email" label="Email" :value="old('email')"
                        class="fa-envelope" />
                    <x-form-input-login type="password" name="password" label="Password" value="" class="fa-key" />
                    <x-button-submit label="simpan" class="btn-primary btn-block" icon="fa-save" />
                </form>
                <footer class="text-xs pt-4">
                    <div>
                        Copyright &copy;
                        <?= date('Y');?>
                        <a href="{{ url('/') }}">{{ $config->app }}</a>.
                    </div>
                    <div>
                        {{ $config->copyright }}
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ url('/') }}/plugins/admin-lte-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="{{ url('/') }}/plugins/admin-lte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/plugins/admin-lte-3.2.0/dist/js/adminlte.js"></script>
</body>

</html>