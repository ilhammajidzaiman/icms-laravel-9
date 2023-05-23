@extends('private.templates.main')

@section('header')
    kategori
@endsection

@section('container')
    <x-button-link href="{{ route('developer.blog.category.create') }}" label="baru"
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
                                <th scope="col">nama</th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col" width="250">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-right">
                                        <x-field-date :create="$category->created_at" :update="$category->updated_at" class="text-xs text-secondary" />
                                    </td>
                                    <td class="text-right">
                                        <x-button-link href="{{ route('developer.blog.category.show', $category->slug) }}"
                                            label="lihat" class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link href="{{ route('developer.blog.category.edit', $category->slug) }}"
                                            label="edit" class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                        <x-button-delete
                                            href="{{ route('developer.blog.category.delete', $category->slug) }}"
                                            confirm="{{ $category->name }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
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
