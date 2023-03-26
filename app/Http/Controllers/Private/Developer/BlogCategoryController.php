<?php

namespace App\Http\Controllers\Private\Developer;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories'        => BlogCategory::orderBy('name')->get(),
        ];
        return view('private.blog-category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data input...
        $name               = $request->name;
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';
        $uuid               = Str::uuid();

        // validation...
        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255', 'unique:blog_categories'],
        ]);

        // insert to table...
        $data = [
            'uuid'          => $uuid,
            'name'          => $name,
            'slug'          => $slug,
        ];
        BlogCategory::create($data);

        // flashdata...
        $flashData = [
            'message'       => 'Data "' . $message . '" ditambahkan!',
            'alert'         => 'primary',
        ];
        return redirect('/developer/blog/category')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $category)
    {
        $data = [
            'category'          => $category,
        ];
        return view('private.blog-category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $category)
    {
        $data = [
            'category'         => $category,
        ];
        return view('private.blog-category.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $category)
    {
        // data detail...
        $oldSlug            = $category->slug;
        $oldName            = $category->name;

        // data input...
        $name               = $request->name;
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';

        // validation logic...
        $oldName            !== $name ? $uName = "unique:blog_categories" : $uName = "";

        // validation...
        $validatedData      = $request->validate([
            'name'         => ['required', 'max:255', $uName],
        ]);

        // insert to table...
        $data = [
            'name'          => $name,
            'slug'          => $slug,
        ];
        BlogCategory::where('slug', $oldSlug)->update($data);

        // flashdata...
        $flashData = [
            'message'       => 'Data "' . $message . '" diubah!',
            'alert'         => 'success',
        ];
        return redirect('/developer/blog/category')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $category)
    {
        // data detail...
        $oldId              = $category->id;
        $oldName            = $category->name;
        $message            = $oldName;

        // delete data on table..
        BlogCategory::destroy($oldId);

        // flashdata...
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/developer/blog/category')->with($flashData);
    }
}
