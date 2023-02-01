<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ url('/'.$segment1.'/profil/'.auth()->user()->uuid) }}" class="dropdown-item">
                    <div class="media">
                        @php
                        $value=auth()->user()->file;
                        $value == 'default-user.svg' ? $url=url('assets/images/'.$value) :
                        $url=asset('storage/'.$value);
                        @endphp
                        <img src="{{ $url }}" alt="{{ $url }}" class="img-size-50 mr-3 img-circle"
                            style="width:50px;height:50px; overflow:hidden;">
                        <div class="media-body">
                            <h3 class="dropdown-item-title mb-2">
                                {{ auth()->user()->name }}
                            </h3>
                            <p class="text-sm text-muted">
                                <i class="fas fa-shield-alt text-smm"></i>
                                {{ auth()->user()->level->name }}
                            </p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ url('/logout') }}" method="post" class="na">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-footer">
                        <i class="nav-icon fas fa-sign-out-alt "></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right text-capitalize">
                <a href="#" class="dropdown-item" data-widget="fullscreen" role="button">
                    <i class="fas fa-expand-arrows-alt mr-2"></i>
                    fullscreen
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-widget="control-sidebar" data-slide="true" role="button">
                    <i class="fas fa-th-large mr-2"></i>
                    customize
                </a>
            </div>
        </li>
    </ul>
</nav>