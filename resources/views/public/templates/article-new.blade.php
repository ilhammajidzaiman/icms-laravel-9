 <div class="card shadow mb-3">
     <div class="card-body">
         <h3 class="text-capitalize">
             terbaru
         </h3>
         @foreach ($newArticles as $newArticle)
             <div class="row pt-4">
                 <div class="col-8 col-md-8">
                     <h6 class="card-text fw-normal">
                         <a href="{{ route('post', $newArticle->slug) }}" class="text-reset">
                             {{ $newArticle->title }}
                         </a>
                     </h6>
                     <div class="card-text">
                         <small class="text-muted">
                             {{ $newArticle->created_at->diffForHumans() }}
                         </small>
                     </div>
                 </div>
                 <div class="col-4 col-md-4">
                     @php
                         $file = $newArticle->file;
                         $path = $newArticle->path;
                         $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                     @endphp
                     <img src="{{ $url }}" class="img-fluid rounded-3" alt="{{ $url }}">
                 </div>
             </div>
         @endforeach
     </div>
 </div>
