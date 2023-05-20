@extends('private.templates.main')

@section('header')
    status
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.status.create') }}" label="baru"
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
                                <th scope="col">warna</th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col" width="250">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($statuses as $status)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        <x-badge class="badge-pill badge-{{ $status->color }}" :label="$status->color" />
                                    </td>
                                    <td class="text-right">
                                        <x-field-date :create="$status->created_at" :update="$status->updated_at" class="text-xs text-secondary" />
                                    </td>
                                    <td class="text-right">
                                        <x-button-link
                                            href="{{ route('developer.management.user.status.show', $status->slug) }}"
                                            label="lihat" class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link
                                            href="{{ route('developer.management.user.status.edit', $status->slug) }}"
                                            label="edit" class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                        <x-button-delete
                                            href="{{ route('developer.management.user.status.delete', $status->slug) }}"
                                            :confirm="$status->name" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <x-alert-empty label="Belum ada data..." />
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
