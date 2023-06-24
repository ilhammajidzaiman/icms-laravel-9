<div class="{{ $class }}">
    <div class="form-group text-capitalize">
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <input type="file" name="{{ $name }}" id="{{ $name }}"
            class="form-control @error($name)is-invalid @enderror" accept="{{ $accept }}">
        @error($name)
            <div id="{{ $name }}" class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
