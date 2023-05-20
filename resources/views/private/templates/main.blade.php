@include('private.templates.header')
@include('private.templates.nav')
@include('private.templates.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm">
                    <a class="text-dark" href="{{ url($segmentLink) }}">
                        <h1 class="text-capitalize">@yield('header')</h1>
                    </a>
                </div>
                <div class="col-sm">
                    <ol class="breadcrumb float-sm-right text-capitalize">
                        @if ($segment1)
                            <li class="breadcrumb-item">{{ $segment1 }}</li>
                        @endif
                        @if ($segment2)
                            <li class="breadcrumb-item">{{ $segment2 }}</li>
                        @endif
                        @if ($segment3)
                            <li class="breadcrumb-item">{{ $segment3 }}</li>
                        @endif
                        @if ($segment4)
                            <li class="breadcrumb-item">{{ $segment4 }}</li>
                        @endif
                        @if ($segment5)
                            <li class="breadcrumb-item">{{ $segment5 }}</li>
                        @endif
                        @if ($segment6)
                            <li class="breadcrumb-item">{{ $segment6 }}</li>
                        @endif
                        @if ($segment7)
                            <li class="breadcrumb-item">{{ $segment7 }}</li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            @yield('container')
        </div>
    </div>
</div>

@include('private.templates.footer')
