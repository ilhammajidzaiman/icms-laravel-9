<x-app-layout>
    <x-slot name="breadcrumb">
        <x-breadcrumb>
            <x-breadcrumb.item href="{{ route('dashboard') }}" value="{{ __('dashboard') }}" />
            <x-breadcrumb.item href="{{ route($page->route . '.index') }}" value="{{ $page->title ?? null }}" />
            <x-breadcrumb.item value="{{ $page->label ?? null }}" />
        </x-breadcrumb>
    </x-slot>

    <x-slot name="header">
        {{ $page->label ?? null }}
        {{ $page->title ?? null }}
        {{ $page->heading ?? null }}
    </x-slot>

    <x-form action="{{ route($page->route . '.reset', ['id' => $record->uuid]) }}" method="post">
        <div class="row">
            <div class="col">
                @method('put')
                @csrf
                <x-form.input>
                    <x-form.input.label for="password" value="{{ __('password') }}" />
                    <x-form.input.text type="password" name="password" id="password" />
                    <x-form.input.error name="password" />
                </x-form.input>
                <x-form.input>
                    <x-form.input.label for="password_confirmation" value="{{ __('konfirmasi password') }}" />
                    <x-form.input.text type="password" name="password_confirmation" id="password_confirmation" />
                    <x-form.input.error name="password_confirmation" />
                </x-form.input>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-link.button href="{{ route($page->route . '.edit', ['id' => $record->uuid]) }}"
                    value="{{ __('kembali') }}" icon="bi bi-arrow-left" class="btn-secondary me-2" />
                <x-button type="submit" value="{{ __('kirim') }}" icon="bi bi-send" />
            </div>
        </div>
    </x-form>

    @push('scripts')
        <script>
            function previewImg() {
                const cover = document.querySelector('#file');
                const imgPreview = document.querySelector('.img-preview');
                const fileCover = new FileReader();
                fileCover.readAsDataURL(cover.files[0]);
                fileCover.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            }
        </script>
    @endpush
</x-app-layout>
