@extends('private.templates.layout')

@section('header')
    rincian halaman
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.page.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="hidden" name="myInput" id="myInput" value="{{ route('/') . '/page/' . $page->slug }}" readonly>
            <button class="text-capitalize rounded-pill btn btn-sm btn-outline-primary mb-4" onclick="copyToClipboard(this)"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to Clipboard">
                <i class="bi bi-clipboard"></i>
                copy link
            </button>
            <h3>{{ $page->title }}</h3>
            <x-field-date :create="$page->created_at" :update="$page->updated_at" class="text-capitalize" />
            <div>{!! $page->content !!}</div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function copyToClipboard(button) {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            var tooltip = bootstrap.Tooltip.getInstance(button);
            tooltip.dispose();
            button.setAttribute("data-bs-original-title", "Copied!");
            bootstrap.Tooltip.getOrCreateInstance(button).show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
