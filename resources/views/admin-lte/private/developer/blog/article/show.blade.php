@extends('admin-lte.private.templates.main')

@section('header')
    posting baru
@endsection

@section('container')
    <x-button-link href="{{ route('developer.blog.post.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <div class="row justify-content-center">
        <div class="col-md-6 mb-5">
            <h3>{{ $article->title }}</h3>
            <div class="text-capitalize">kategori:
                @forelse ($blogPosts as $blogPost)
                    {{ $blogPost->category->name }},
                @empty
                    tidak ada kategori
                @endforelse
            </div>
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
