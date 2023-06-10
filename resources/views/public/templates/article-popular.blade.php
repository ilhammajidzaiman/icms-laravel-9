 <div class="card shadow mb-3">
     <div class="card-body">
         <h3 class="text-capitalize">
             populer
         </h3>
         @foreach ($popularArticles as $popularArticle)
             <div class="row pt-4">
                 <div class="col-8 col-md-8">
                     <h6 class="card-text fw-normal">
                         <a href="{{ route('post', $popularArticle->slug) }}" class="text-reset">
                             {{ $popularArticle->title }}
                         </a>
                     </h6>
                     <div class="card-text">
                         <small class="text-muted">
                             {{ $popularArticle->created_at->diffForHumans() }}
                         </small>
                     </div>
                 </div>
                 <div class="col-4 col-md-4">
                     @php
                         $file = $popularArticle->file;
                         $path = $popularArticle->path;
                         $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                     @endphp
                     <img src="{{ $url }}" class="img-fluid rounded-3" alt="{{ $url }}">
                 </div>
             </div>
         @endforeach
     </div>
 </div>
