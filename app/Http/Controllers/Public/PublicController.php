<?php

namespace App\Http\Controllers\Public;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use App\Models\Blog\BlogArticle;
use App\Http\Controllers\Controller;
use App\Models\NavMenu\NavMenuParent;

class PublicController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['articles']               = BlogArticle::filter($search)->orderByDesc('id')->paginate(8)->withQueryString();
        $data['newArticles']            = BlogArticle::orderByDesc('id')->take(3)->get();
        $data['slideshows']             = Slideshow::where('status_id', 1)->orderByDesc('id')->take(3)->get();
        $data['slideArticles']          = BlogArticle::orderByDesc('id')->take(5)->get();
        $data['navMenuParents']         = NavMenuParent::orderBy('order')->get();
        return view('public.index', $data);
    }

    public function page($id)
    {
        return $id;
    }

    public function post($id)
    {
        return $id;
    }
}
