<form action="{{ $href }}" method="post" class="d-inline">
    @method('delete')
    @csrf
    <button type="submit" class="text-capitalize {{ $class }}"
        onclick="return confirm('Hapus {{ $confirm }} ?')">
        <i class="{{ $icon }}"></i>
        {{ $label }}
    </button>
</form>
