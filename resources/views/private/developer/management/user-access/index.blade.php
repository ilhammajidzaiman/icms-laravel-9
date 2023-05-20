@extends('private.templates.main')

@section('header')
    akses
@endsection

@section('container')
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
                                <th scope="col" width="250">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($levels as $level)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $level->name }}</td>
                                    <td class="text-right">
                                        <x-button-link href="{{ route('developer.management.access.show', $level->slug) }}"
                                            label="lihat" class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link href="{{ route('developer.management.access.edit', $level->slug) }}"
                                            label="edit" class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
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
