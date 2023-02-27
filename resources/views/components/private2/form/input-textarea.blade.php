<div class="form-group text-capitalize {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control @error($name)is-invalid @enderror" name="{{ $name }}" id="{{ $name }}" cols="30"
        rows="{{ $rows }}" placeholder="masukkan {{ $label }}">{{ $value }}</textarea>
    @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>