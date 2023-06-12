<section class="wrapper pt-5" id="galery">
    <div class="container-fluid mt-5 p-3">
        <h3 class="text-capitalize text-start text-sm-start text-md-center">
            galeri
        </h3>
        <div class="row" data-masonry="{&quot;percentPosition&quot;: true }">
            @forelse ($galeries as $galery)
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="card text-bg-dark">
                        @php
                            $file = $galery->file;
                            $path = $galery->path;
                            $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                        @endphp
                        <img src="{{ $url }}" alt="{{ $url }}" class="card-img">
                        <div class="card-img-overlay text-shadow">
                            <small class="card-text fw-light d-none d-md-block">
                                {{ $galery->title }}
                            </small>
                            <small class="card-text fw-light d-none d-lg-block">
                                {{ $article->created_at->diffForHumans() }}
                                {{ $article->created_at->format('d-m-Y, H:i:s') }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
