<div class="form-group text-capitalize {{ $class }}">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>
    <input type="{{ $type }}" class="form-control @error($name)is-invalid @enderror" name="{{ $name }}"
        id="{{ $name }}" value="{{ $value }}" placeholder="Masukkan {{ $label }}">
    @error($name)
        <div id="{{ $name }}" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
