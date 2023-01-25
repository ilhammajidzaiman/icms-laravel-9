<!doctype html>
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
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fontawesome5/css/all.css">
    <link href="{{ url('/') }}/plugins/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            min-height: 250px;
            padding: 0;
            margin: 0;
            background-repeat: no-repeat;
            background-color: #B9DFF5;
            border-radius: 0 0 50px 50px;
        }
    </style>
</head>

<body class="bg-light">
    <section class="wrapper bg-primaryy hero">
        <div class="container-xxl p-5">
        </div>
    </section>

    <section class="wrapper" style="margin-top: -100px;">
        <div class="container-xxl">