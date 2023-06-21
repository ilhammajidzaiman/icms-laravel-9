<div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3 class="mb-4 text-capitalize">
            <a href="{{ URL::current() }}" class="text-reset">
                @yield('header')
            </a>
        </h3>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb text-capitalize">
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
        </nav>
    </div>
</div>
