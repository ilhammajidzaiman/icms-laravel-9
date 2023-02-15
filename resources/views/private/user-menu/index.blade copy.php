@extends('private.templates.main')
@section('container')

<x-private.button.link-create :href="$segmentHref" />
<x-private.alert.dismissing />

<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <tbody>

                        @forelse ($menus as $menu1)

                        @if ((empty($menu1->url)) || ($menu1->url==='#'))
                        {{-- jika url kosong atau pagar --}}
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td class="border-0">
                                <i class="text-primary expandable-table-caret fas fa-caret-right fa-fw"></i>
                                <span class="badge badge-secondary">{{ $menu1->order }}</span>
                                {{ $menu1->name }}
                                ,url:
                                {{ $menu1->url }}
                                <span class="float-right">
                                    <x-private.button.link-create-sub :href="$segmentHref.'/'.$menu1->slug" />
                                    <x-private.button.link-read :href="$segmentHref.'/'.$menu1->slug" />
                                    <x-private.button.link-update :href="$segmentHref.'/'.$menu1->slug" />
                                    @php
                                    $menu=App\Models\Menu::where('parent_id',$menu1->id)->first();
                                    @endphp
                                    @empty($menu)
                                    <x-private.button.button-delete :href="$segmentHref.'/'.$menu1->slug"
                                        :confirm="$menu1->name" />
                                    @endempty
                                </span>
                            </td>
                        </tr>
                        <tr class="expandable-body">
                            <td>
                                <div class="p-0">
                                    <table class="table table-hover">
                                        <tbody>


                                            @php
                                            $menus2=App\Models\Menu::where('parent_id',$menu1->id)->orderBy('id')->get();
                                            @endphp

                                            @forelse ($menus2 as $menu2)

                                            <tr>
                                                <td>
                                                    <i class="text-dark fas fa-caret-right fa-fw"></i>
                                                    <span class="badge badge-secondary">{{ $menu2->order }}</span>
                                                    {{ $menu2->name }}
                                                    <span class="float-right">
                                                        <x-private.button.link-read
                                                            :href="$segmentHref.'/'.$menu2->slug" />
                                                        <x-private.button.link-update
                                                            :href="$segmentHref.'/'.$menu2->slug" />
                                                        <x-private.button.button-delete
                                                            :href="$segmentHref.'/'.$menu2->slug"
                                                            :confirm="$menu2->name" />
                                                    </span>
                                                </td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td>
                                                    <x-private.alert.alert-empty />
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>






                        @else
                        {{-- jika url ada --}}
                        <tr>
                            <td class="border-0">
                                <i class="text-dark fas fa-caret-right fa-fw"></i>
                                <span class="badge badge-secondary">{{ $menu1->order }}</span>
                                {{ $menu1->name }}
                                {{ $menu1->url }}
                                <span class="float-right">
                                    <x-private.button.link-read :href="$segmentHref.'/'.$menu1->slug" />
                                    <x-private.button.link-update :href="$segmentHref.'/'.$menu1->slug" />
                                    <x-private.button.button-delete :href="$segmentHref.'/'.$menu1->slug"
                                        :confirm="$menu1->name" />
                                </span>
                            </td>
                        </tr>
                        @endif

                        @empty
                        <tr>
                            <td>
                                <x-private.alert.alert-empty />
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection