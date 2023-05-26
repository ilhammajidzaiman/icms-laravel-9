@extends('admin-lte.private.templates.main')

@section('header')
    posting
@endsection

@section('container')
    <x-button-link href="{{ route('developer.blog.post.create') }}" label="baru"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-plus" />

    <x-alert-dismissing />

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="text-capitalize">
                                <th scope="col">#</th>
                                <th scope="col">judul</th>
                                <th scope="col">pengarang</th>
                                <th scope="col">status</th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col" width="250">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>
                                        <x-badge class="badge-pill badge-{{ $article->status->color }}"
                                            label="{{ $article->status->name }}" />
                                    </td>
                                    <td class="text-right">
                                        <x-field-date :create="$article->created_at" :update="$article->updated_at" class="text-xs text-secondary" />
                                    </td>
                                    <td class="text-right">
                                        <x-button-link href="{{ route('developer.blog.post.show', $article->slug) }}"
                                            label="lihat" class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link href="{{ route('developer.blog.post.edit', $article->slug) }}"
                                            label="edit" class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                        <x-button-delete href="{{ route('developer.blog.post.delete', $article->slug) }}"
                                            confirm="{{ $article->title }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <x-alert-empty />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
