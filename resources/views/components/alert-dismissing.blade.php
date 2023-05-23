@php
    $message = session('message');
    $alert = session('alert');
    $icon = session('icon');
@endphp
@if ($message)
    <div class="alert alert-{{ $alert }} alert-dismissible fade show" role="alert">
        <div>
            <i class="fa-fw fas fa-{{ $icon }} mr-2"></i>
            {{ $message }}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
