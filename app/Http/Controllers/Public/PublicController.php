<?php

namespace App\Http\Controllers\Public;

use App\Models\Page;
use App\Models\Galery;
use App\Models\Archive;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use App\Models\Blog\BlogArticle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['articles']               = BlogArticle::filter($search)->orderByDesc('id')->paginate(8)->withQueryString();
        $data['slideshows']             = Slideshow::where('status_id', 1)->orderByDesc('id')->take(3)->get();
        $data['slideArticles']          = BlogArticle::orderByDesc('id')->take(5)->get();
        $data['newArticles']            = BlogArticle::orderByDesc('id')->take(3)->get();
        $data['popularArticles']        = BlogArticle::orderByDesc('counter')->take(4)->get();
        $data['galeries']               = Galery::where('status_id', 1)->orderByDesc('id')->take(8)->get();
        return view('public.index', $data);
    }

    public function post($id)
    {
        // counter
        $data['article']                = BlogArticle::where('slug', $id)->first();
        $count                          = $data['article']->counter;
        $counter                        = $count + 1;
        $data = [
            'counter'                   => $counter,
        ];
        BlogArticle::where('slug', $id)->update($data);

        // 
        $data['article']                = BlogArticle::where('slug', $id)->first();
        $data['newArticles']            = BlogArticle::orderByDesc('id')->take(3)->get();
        $data['popularArticles']        = BlogArticle::orderByDesc('counter')->take(6)->get();
        return view('public.post', $data);
    }

    public function page($id)
    {
        $data['page']                   = Page::where('slug', $id)->first();
        $data['newArticles']            = BlogArticle::orderByDesc('id')->take(3)->get();
        $data['popularArticles']        = BlogArticle::orderByDesc('counter')->take(6)->get();
        return view('public.page', $data);
    }

    public function download()
    {
        $data['archives']               = Archive::orderByDesc('id')->get();
        $data['newArticles']            = BlogArticle::orderByDesc('id')->take(3)->get();
        $data['popularArticles']        = BlogArticle::orderByDesc('counter')->take(6)->get();
        return view('public.download', $data);
    }

    public function downloadFile($id)
    {
        $data['archive']                = Archive::where('uuid', $id)->first();
        $path                           = $data['archive']->path;
        $file                           = $data['archive']->file;
        return Storage::download($path . $file);
    }
}
