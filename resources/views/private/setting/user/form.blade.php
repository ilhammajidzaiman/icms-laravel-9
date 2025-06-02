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

    <x-form action="{{ route($page->route . '.' . $page->routeName, ['id' => $record->uuid]) }}" method="post"
        enctype="multipart/form-data">
        @method($page->method ?? null)
        @csrf
        <div class="row">
            <div class="col-md-9">
                <x-form.input>
                    <x-form.input.label for="name" value="{{ __('nama') }}" />
                    <x-form.input.text type="text" name="name" id="name"
                        value="{{ old('name', $record->name ?? null) }}" />
                    <x-form.input.error name="name" />
                </x-form.input>
                <x-form.input>
                    <x-form.input.label for="birth_date" value="{{ __('tanggal lahir') }}" />
                    <x-form.input.text type="date" name="birth_date" id="birth_date"
                        value="{{ old('birth_date', $record->profile?->birth_date ?? null) }}" />
                    <x-form.input.error name="birth_date" />
                </x-form.input>
                <x-form.input>
                    <label class="form-label">Jenis Kelamin</label>
                    @foreach ($gender as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="{{ $item->value }}"
                                value="{{ $item->value }}" @if (old('gender', $record->profile?->gender) === $item->value || $item->value === 'male') checked @endif>
                            <label class="form-check-label" for="{{ $item->value }}">
                                {{ $item->label() }}
                            </label>
                        </div>
                    @endforeach
                </x-form.input>
                <x-form.input>
                    <x-form.input.label for="username" value="{{ __('username') }}" />
                    <x-form.input.text type="text" name="username" id="username"
                        value="{{ old('username', $record->username ?? null) }}" />
                    <x-form.input.error name="username" />
                </x-form.input>
                <x-form.input>
                    <x-form.input.label for="email" value="{{ __('email') }}" />
                    <x-form.input.text type="email" name="email" id="email"
                        value="{{ old('email', $record->email ?? null) }}" />
                    <x-form.input.error name="email" />
                </x-form.input>
                @if ($page->routeName === 'store')
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
                @endif
                @if ($page->routeName === 'update')
                    <div class="mb-3">
                        Reset password
                        <a href="{{ route($page->route . '.password', ['id' => $record->uuid ?? null]) }}">
                            {{ __('disini') }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-3">

                <x-form.input>
                    <x-form.input.label for="role" value="{{ __('kategori') }}" />
                    <select name="role" id="role" class="form-select" data-placeholder="{{ __('pilih...') }}">
                        <option value="">Pilih...</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}"
                                {{ old('role', $record->blog_role_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.input.error name="level" />
                </x-form.input>

                <x-form.input>
                    <x-form.input.label for="file" value="{{ __('file') }}" />
                    <input type="file" name="file" id="file" class="filepond"
                        data-file-record="{{ $record->profile?->file ? Storage::url($record->profile?->file) : null }}" />
                </x-form.input>
            </div>
        </div>

        <div class="row">
            <div class="col mt-3">
                <x-link.button href="{{ route($page->route . '.index') }}" value="{{ __('kembali') }}"
                    icon="bi bi-arrow-left" class="btn-secondary me-2" />
                <x-button type="submit" value="{{ __('kirim') }}" icon="bi bi-send" />
            </div>
        </div>
    </x-form>
</x-app-layout>
