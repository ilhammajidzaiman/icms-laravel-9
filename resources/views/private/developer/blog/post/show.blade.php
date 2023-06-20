@extends('private.templates.layout')

@section('header')
    rincian posting
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.blog.post.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row justify-content-center">
        <div class="col-md-6">

            <input type="hidden" name="myInput" id="myInput" value="{{ route('/') . '/post/' . $article->slug }}" hidden
                readonly>
            <button class="text-capitalize rounded-pill btn btn-sm btn-outline-primary mb-4" onclick="copyToClipboard(this)">
                <i class="bi bi-clipboard"></i>
                copy link
            </button>

            <h3>{{ $article->title }}</h3>
            <nav style="--bs-breadcrumb-divider:',';" aria-label="breadcrumb">
                <ol class="breadcrumb text-capitalize mb-0">
                    <span class="pe-1">
                        kategori:
                    </span>
                    @forelse ($blogPosts as $blogPost)
                        <li class="breadcrumb-item">
                            {{ $blogPost->category->name }}
                        </li>
                    @empty
                        <li class="breadcrumb-item">
                            tidak ada kategori
                        </li>
                    @endforelse
                </ol>
            </nav>
            <x-field-date :create="$article->created_at" :update="$article->updated_at" class="text-capitalize" />
            <div class="text-capitalize mb-3">oleh: {{ $article->user->name }}</div>
            @php
                $file = $article->file;
                $path = $article->path;
                $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
            @endphp
            <img src="{{ $url }}" alt="{{ $url }}" class="img-fluid rounded w-100 mb-3 mb-4">
            <div>{!! $article->content !!}</div>

        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        /* with button */
        function copyToClipboard(button) {
            var copyText = document.getElementById("myInput").value;
            var tempInput = document.createElement("input");
            tempInput.setAttribute("value", copyText);
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            button.innerHTML = '<i class="bi bi-clipboard-check"></i> copied';
            button.disabled = true;
            setTimeout(function() {
                button.innerHTML = '<i class="bi bi-clipboard"></i> copy';
                button.disabled = false;
            }, 3000);
        }
    </script>
@endsection
