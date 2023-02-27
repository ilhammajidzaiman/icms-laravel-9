<div class="form-group text-capitalize {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="password" class="form-control @error($name)is-invalid @enderror" name="{{ $name }}" id="{{ $name }}"
        placeholder="Masukkan {{ $label }}">
    @error($name)<div class="invalid-feedback">{{ $message }}</div> @enderror
</div>