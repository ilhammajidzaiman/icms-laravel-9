@php
    $message = session('message');
    $alert = session('alert');
    $icon = session('icon');
@endphp
@if ($message)
    <div class="alert alert-{{ $alert }} alert-dismissible fade show" role="alert">
        <i class="{{ $icon }} me-2"></i>
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
