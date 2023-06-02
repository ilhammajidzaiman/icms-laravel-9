@extends('private.templates.layout')

@section('header')
    posting
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.blog.post.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    <x-alert-dismissing />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <form action="{{ route(Request::segment(1) . '.blog.post.index') }}" method="get">
                            <div class="row justify-content-end">
                                <x-search-input name="search" id="search" value="{{ request('search') }}"
                                    class="col-md-4" />
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th>#</th>
                                        <th>judul</th>
                                        <th>pengarang</th>
                                        <th>status</th>
                                        <th>&nbsp;</th>
                                        <th width="250">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($articles as $key=>$article)
                                        <tr>
                                            <td>{{ $articles->firstItem() + $key }}</td>
                                            <td>{{ $article->title }}</td>
                                            <td>{{ $article->user->name }}</td>
                                            <td>
                                                <x-badge class="badge rounded-pill bg-{{ $article->status->color }}"
                                                    label="{{ $article->status->name }}" />
                                            </td>
                                            <td class="text-end">
                                                <x-field-date :create="$article->created_at" :update="$article->updated_at" class="text-secondary" />
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.blog.post.show', $article->slug) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.blog.post.edit', $article->slug) }}"
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.blog.post.delete', $article->slug) }}"
                                                    confirm="{{ $article->name }}"
                                                    class="rounded-pill btn btn-sm btn-outline-danger" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <x-alert-empty label="Data tidak ditemukan..." />
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-pagination :pages="$articles" side="1" />
        </div>
    </div>
@endsection
