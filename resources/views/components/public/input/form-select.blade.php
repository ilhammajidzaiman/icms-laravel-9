<div class="{{ $class }}">
    <div class="form-floating mb-3">
        <select id="{{ $id }}" name="{{ $name }}" class="form-select @error($name)is-invalid @enderror">
            <option value="">Pilih {{ $label }}...</option>
            {{ $slot }}
        </select>
        <label for="{{ $id }}">{{ $label }}</label>
        @error($name)<div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>