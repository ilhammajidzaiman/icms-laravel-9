<label for="{{ $name }}" class="text-capitalize">{{ $label }}</label>
<img src="{{ $value }}" alt="{{ $value }}" class="img-fluid rounded w-100 mb-3 img-preview">
<div class="form-group">
    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="{{ $accept }}" class="form-control-file"
        onchange="previewImg()">
</div>