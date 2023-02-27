<div class="input-group mb-3">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control @error($name)is-invalid @enderror"
        value="{{ $value }}" placeholder="{{ $label }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas {{ $class }}"></span>
        </div>
    </div>
    @error($name)<div class="invalid-feedback">{{ $message }}</div> @enderror
</div>