<div class="{{ $class }}">
    <div class="form-group text-capitalize">
        <img src="{{ $value }}" alt="{{ $value }}" class="img-fluid rounded w-100 mb-3 img-preview">
        <label for="{{ $name }}" class="form-label">thumbnail</label>
        <input type="file" name="{{ $name }}" id="{{ $name }}"
            class="form-control @error('{{ $name }}')is-invalid @enderror" accept=".jpg,.jpeg,.png"
            onchange="previewImg()">
        @error('{{ $name }}')
            <div id="{{ $name }}" class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
