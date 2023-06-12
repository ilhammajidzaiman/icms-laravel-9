<section class="wrapper pt-5" id="slideshow">
    <div id="carouselControls1" class="carousel slide mt-4 pt-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @php
                $no = 0;
            @endphp
            @foreach ($slideshows as $slideshow)
                @php
                    $no == 0 ? ($class = 'active') : ($class = '');
                @endphp
                <button type="button" data-bs-target="#carouselControls1" data-bs-slide-to="{{ $no++ }}"
                    class="{{ $class }}" aria-current="true" aria-label="slide {{ $loop->iteration }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner rounded-0">
            @php
                $no = 0;
            @endphp
            @foreach ($slideshows as $slideshow)
                @php
                    $no == 0 ? ($class = 'active') : ($class = '');
                @endphp
                <div class="carousel-item carousel-item-overlay <?= $class ?>" data-bs-interval="5000">
                    @php
                        $file = $slideshow->file;
                        $path = $slideshow->path;
                        $file == 'default-slideshow.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                    @endphp
                    <img src="{{ $url }}" class="d-block w-100" alt="{{ $url }}"
                        aria-label="slide {{ $no++ }}">
                    <div class="carousel-caption carousel-caption-overlay mt-5">
                        <h3 class="text-reset d-none d-md-block">{{ $slideshow->title }}</h3>
                        <p class="d-none d-lg-block">{{ $slideshow->detail }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
