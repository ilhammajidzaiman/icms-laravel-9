<?php

namespace App\Http\Controllers\Public;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use App\Models\Blog\BlogArticle;
use App\Http\Controllers\Controller;
use App\Models\NavMenu\NavMenuParent;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
