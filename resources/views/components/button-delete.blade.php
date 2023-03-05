<form action="{{ $href }}" method="post" class="d-inline">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill text-capitalize"
        onclick="return confirm('Hapus data {{ $confirm }} ?')">
        <i class="fa-fw fas fa-trash"></i>
        hapus
    </button>
</form>