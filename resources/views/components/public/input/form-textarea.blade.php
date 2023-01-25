<div class="{{ $class }}">
    <div class="form-floating mb-3">
        <textarea class="form-control @error($name)is-invalid @enderror" name="{{ $name }}" id="{{ $id }}"
            placeholder="masukkan {{ $name }}" style="min-height: 100px">{{ $value }}</textarea>
        <label for="{{ $id }}" class="text-capitalize">{{ $label }}</label>
        @error($name)<div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>