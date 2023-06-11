<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}">
</head>
<title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row" data-masonry="{&quot;percentPosition&quot;: true }">
                @forelse ($articles as $article)
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card text-bg-dark">
                            @php
                                $file = $article->file;
                                $path = $article->path;
                                $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                            @endphp
                            <img src="{{ $url }}" alt="{{ $url }}" class="card-img">
                            <div class="card-img-overlay">
                                <h5 class="card-title">
                                    {{ $article->title }}
                                </h5>
                                <p class="card-text">
                                    {{ $article->truncated }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>






    <script src="{{ asset('/plugins/js/popper.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/plugins/js/masonry.pkgd.min.js') }}"></script>
</body>

</html>
