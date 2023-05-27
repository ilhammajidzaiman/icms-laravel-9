@extends('private.templates.layout')

@section('header')
    posting
@endsection

@section('container')
    <x-alert-dismissing />

    <x-button-link href="{{ route('developer.blog.post.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
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
                                    @forelse ($articles as $article)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
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
                                                    href="{{ route('developer.blog.post.show', $article->slug) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route('developer.blog.post.edit', $article->slug) }}"
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route('developer.blog.post.delete', $article->slug) }}"
                                                    confirm="{{ $article->name }}"
                                                    class="rounded-pill btn btn-sm btn-outline-danger" />
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
        </div>
    </div>
@endsection
