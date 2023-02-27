<div class="form-group text-capitalize {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        placeholder="Masukkan {{ $label }}" readonly>
</div>