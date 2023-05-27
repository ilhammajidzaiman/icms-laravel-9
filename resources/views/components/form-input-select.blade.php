<div class="form-group text-capitalize {{ $class }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name)is-invalid @enderror">
        {{-- <option value="">Pilih {{ $label }}...</option> --}}
        {{ $slot }}
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
