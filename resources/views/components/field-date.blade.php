<div class="{{ $class }}">
    @php
    $created=$create;
    $updated=$update;
    @endphp
    @if ($created==$updated)
    {{ 'dibuat '.$created->diffForHumans().', '.$created->format('d-m-Y, H:i:s') }}
    @else
    {{ 'diubah '.$updated->diffForHumans().', '.$updated->format('d-m-Y, H:i:s') }}
    @endif
</div>