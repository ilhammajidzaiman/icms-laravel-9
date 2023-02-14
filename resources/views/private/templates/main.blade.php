@include('private.templates.header')
@include('private.templates.nav')
@include('private.templates.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="text-dark" href="{{ url($segmentUrl) }}">
                        <h1 class="text-capitalize">{{ $segment2=='master'?$segment3:$segment2 }}</h1>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-capitalize">
                        @if ($segment1)
                        <li class="breadcrumb-item">{{ $segment1 }}</li>
                        @endif

                        @if ($segment2)
                        <li class="breadcrumb-item">
                            @if ($segment2==='master')
                            {{ $segment2 }}
                            @elseif ($segment2==='profil')
                            {{ $segment2 }}
                            @else
                            <a href="{{ url($segment1.'/'.$segment2) }}">{{ $segment2 }}</a>
                            @endif
                        </li>
                        @endif

                        @if ($segment3)
                        <li class="breadcrumb-item">
                            <a href="{{ url($segment1.'/'.$segment2.'/'.$segment3) }}">
                                {{ $segment3 }}
                            </a>
                        </li>
                        @endif

                        @if ($segment4)
                        <li class="breadcrumb-item">
                            <a href="{{ url($segment1.'/'.$segment2.'/'.$segment3.'/'.$segment4) }}">
                                {{ $segment4 }}
                            </a>
                        </li>
                        @endif

                        @if ($segment5)
                        <li class="breadcrumb-item">
                            <a href="{{ url($segment1.'/'.$segment2.'/'.$segment3.'/'.$segment4.'/'.$segment5) }}">
                                {{ $segment5 }}
                            </a>
                        </li>
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