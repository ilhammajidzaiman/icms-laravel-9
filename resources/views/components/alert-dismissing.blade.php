@php
$message =session('message');
$alert =session('alert');
@endphp

@if ($message)
<div class="alert alert-{{ $alert }} alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif