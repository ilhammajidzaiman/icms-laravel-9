@extends('private.templates.main')
@section('container')
    <x-button-link :href="$segmentUrl . '/create'" label="baru" class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-plus" />
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
                                        <x-badge class="badge-pill badge-{{ $article->status->color }}" :label="$article->status->name" />
                                    </td>
                                    <td class="text-right">
                                        <x-field-date :create="$article->created_at" :update="$article->updated_at" class="text-xs text-secondary" />
                                    </td>
                                    <td class="text-right">
                                        <x-button-link :href="$segmentUrl . '/' . $article->slug" label="lihat"
                                            class="rounded-pill btn-xs btn-outline-primary" icon="fa-eye" />
                                        <x-button-link :href="$segmentUrl . '/' . $article->slug . '/edit'" label="edit"
                                            class="rounded-pill btn-xs btn-outline-success" icon="fa-edit" />
                                        <x-button-delete :href="$segmentUrl . '/' . $article->slug" :confirm="$article->title" />
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
