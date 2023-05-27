<form action="{{ $href }}" method="post" class="d-inline">
    @method('delete')
    @csrf
    <button type="submit" class="text-capitalize {{ $class }}"
        onclick="return confirm('Hapus {{ $confirm }} ?')">
        <i class="fa-fw fas fa-trash"></i>
        {{-- <i class="{{ $icon }}"></i> --}}
        hapus
    </button>
</form>
