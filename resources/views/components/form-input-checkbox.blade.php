<div class="form-check">
    <input type="checkbox" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
        class="form-check-input form-check-primary" {{ $checked }}>
    {{ $slot }}
</div>
