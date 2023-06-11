 <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
     <div class="container-fluid">
         <a class="navbar-brand" href="{{ route('/') }}">
             <img src="{{ asset('assets/images/' . config('app.icon')) }}" alt="Logo {{ config('app.icon') }}"
                 width="30" height="30" class="d-inline-block align-text-top">
             {{ config('app.name') }}
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
             aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
             <div class="offcanvas-header">
                 <h5 class="offcanvas-title" id="offcanvasRightLabel">
                     <a href="{{ route('/') }}" class="text-reset">
                         {{ config('app.name') }}
                     </a>
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
             </div>
             <div class="offcanvas-body">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     @php
                         $navMenuParents = App\Models\NavMenu\NavMenuParent::orderBy('order')->get();
                     @endphp
                     {{-- $data['navMenuParents'] = NavMenuParent::orderBy('order')->get(); --}}
                     @forelse ($navMenuParents as $navMenuParent)
                         @php
                             $hasParent = App\Models\NavMenu\navMenuParent::where('id', $navMenuParent->id)->first();
                             //
                             $hasChild = App\Models\NavMenu\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)->first();
                             //
                             $navMenuChildren = App\Models\NavMenu\NavMenuChild::where('nav_menu_parent_id', $navMenuParent->id)
                                 ->orderBy('order')
                                 ->get();
                         @endphp
                         @if ($hasChild)
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href=" {{ $navMenuParent->url }}" role="button"
                                     data-bs-toggle="dropdown" aria-expanded="false">
                                     {{ $navMenuParent->name }}
                                 </a>
                                 <ul class="dropdown-menu">
                                     @foreach ($navMenuChildren as $navMenuChild)
                                         <li>
                                             <a class="dropdown-item" href="{{ $navMenuChild->url }}">
                                                 {{ $navMenuChild->name }}
                                             </a>
                                         </li>
                                     @endforeach
                                 </ul>
                             </li>
                         @else
                             <li class="nav-item">
                                 <a class="nav-link" aria-current="page" href="{{ $navMenuParent->url }}">
                                     {{ $navMenuParent->name }}
                                 </a>
                             </li>
                         @endif
                     @empty
                         <li class="nav-item">
                             <a class="nav-link" href="#">Menu</a>
                         </li>
                     @endforelse
                 </ul>
                 <form action="{{ route('/') }}" method="get" class="d-flex" role="search">
                     <div class="input-group">
                         <button type="submit" id="button-addon1" class="btn btn-light text-capitalize">
                             <i class="bi bi-search"></i>
                             cari
                         </button>
                         <input type="text" name="search" id="search" value="{{ request('search') }}"
                             class="form-control" placeholder="disini...">
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </nav>
