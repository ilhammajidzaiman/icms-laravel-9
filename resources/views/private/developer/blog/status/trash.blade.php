@extends('private.templates.layout')

@section('header')
    sampah
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.blog.status.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <x-alert-dismissing />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <form action="{{ route(Request::segment(1) . '.blog.status.trash.index') }}" method="get">
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
                                        <th>warna</th>
                                        <th>&nbsp;</th>
                                        <th width="250">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($statuses as $key=>$status)
                                        <tr>
                                            <td>{{ $statuses->firstItem() + $key }}</td>
                                            <td>{{ $status->name }}</td>
                                            <td>
                                                <x-badge class="rounded-pill bg-{{ $status->color }}"
                                                    label="{{ $status->color }}" />
                                            </td>
                                            <td class="text-end">
                                                <x-field-date-delete :delete="$status->deleted_at" class="text-secondary" />
                                            </td>
                                            <td class="text-end">
                                                <x-button-link
                                                    href="{{ route(Request::segment(1) . '.blog.status.trash.restore', $status->uuid) }}"
                                                    label="pulihkan" class="rounded-pill btn btn-sm btn-outline-info"
                                                    icon="fa-fw fas fa-recycle" />
                                                <x-button-delete
                                                    href="{{ route(Request::segment(1) . '.blog.status.trash.delete', $status->uuid) }}"
                                                    confirm="permanen {{ $status->name }}" label="hapus"
                                                    class="rounded-pill btn btn-sm btn-outline-danger"
                                                    icon="fa-fw fas fa-trash" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <x-alert-empty label="Tidak ada sampah ditemukan..." />
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-pagination :pages="$statuses" side="1" />
        </div>
    </div>
@endsection
