<div class="{{ $class }}">
    <div class="form-floating mb-3">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
            class="form-control @error($name)is-invalid @enderror" placeholder="masukkan {{ $name }}">
        <label for="{{ $id }}" class="text-capitalize">{{ $label }}</label>
        @error($name)<div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>