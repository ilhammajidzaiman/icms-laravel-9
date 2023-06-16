@extends('private.templates.layout')

@section('header')
    kategori
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.blog.category.create') }}" label="baru"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-plus" />

    <x-button-link href="{{ route(Request::segment(1) . '.blog.category.trash.index') }}"
        label="sampah ({{ $countCategory }})" class="float-end" icon="fa-fw fas fa-trash" />

    <x-alert-dismissing />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <form action="{{ route(Request::segment(1) . '.blog.category.index') }}" method="get">
                            @csrf
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
                                        <th>nama</th>
                                        <th>&nbsp;</th>
                                        <th width="250">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $key=>$category)
                                        <tr>
                                            <td>{{ $categories->firstItem() + $key }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td class="text-end">
                                                <x-field-date :create="$category->created_at" :update="$category->updated_at" class="text-secondary" />
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.blog.category.show', $category->slug) }}"
                                                    label="lihat" class="rounded-pill btn btn-sm btn-outline-primary"
                                                    icon="fa-fw fas fa-eye" />
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.blog.category.edit', $category->slug) }}"
                                                    label="edit" class="rounded-pill btn btn-sm btn-outline-success"
                                                    icon="fa-fw fas fa-edit" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.blog.category.delete', $category->slug) }}"
                                                    confirm="{{ $category->name }}" label="hapus"
                                                    class="rounded-pill btn btn-sm btn-outline-danger"
                                                    icon="fa-fw fas fa-trash" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
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
            <x-pagination :pages="$categories" side="1" />
        </div>
    </div>
@endsection
