<textarea name="{{ $name }}" id="summernote" cols="30" rows="10"
    class="@error($name) is-invalid @enderror">{{ $value }}</textarea>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
