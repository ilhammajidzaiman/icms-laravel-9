<header class='mb-33'>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto mb-lg-0">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                @php
                                    $path = auth()->user()->path;
                                    $file = auth()->user()->file;
                                    $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                @endphp
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                    <p class="mb-0 text-sm text-gray-600"> {{ auth()->user()->level->name }}</p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="{{ $url }}" alt="{{ $url }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem;">
                            <li>
                                <h6 class="dropdown-header">{{ auth()->user()->name }}</h6>
                            </li>
                            <li>
                                <a class="dropdown-item text-capitalize"
                                    href="{{ route(Request::segment(1) . '.profil.index', auth()->user()->uuid) }}">
                                    <i class="icon-mid bi bi-person me-2"></i>
                                    profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-capitalize"
                                    href="{{ route(Request::segment(1) . '.profil.edit', auth()->user()->uuid) }}">
                                    <i class="icon-mid bi bi-gear me-2"></i>
                                    account
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            {{-- <li>
                                <a class="dropdown-item text-capitalize" href="{{ route('auth.logout') }}">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                    logout
                                </a>
                            </li> --}}
                            <li>
                                <form action="{{ route('auth.signout') }}" method="post" class="na">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-capitalize">
                                        <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                        logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</header>
