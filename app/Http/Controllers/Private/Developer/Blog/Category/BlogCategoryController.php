<?php

namespace App\Http\Controllers\Private\Developer\Blog\Category;

use Illuminate\Support\Str;
use App\Models\Blog\BlogCategory;
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
        $search                     = request(['search']);
        $data['categories']         = BlogCategory::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        $data['count']              = BlogCategory::onlyTrashed()->get()->count();
        return view('private.developer.blog.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.developer.blog.category.create');
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
        $name                       = $request->name;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');
        $uuid                       = Str::uuid();

        // validation...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', 'unique:blog_categories'],
        ]);

        // insert to table...
        $data = [
            'uuid'                  => $uuid,
            'name'                  => $name,
            'slug'                  => $slug,
        ];
        BlogCategory::create($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" ditambahkan!',
            'alert'                 => 'primary',
            'icon'                  => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.blog.category.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['category']           = BlogCategory::where('uuid', $id)->first();
        return view('private.developer.blog.category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category']           = BlogCategory::where('uuid', $id)->first();
        return view('private.developer.blog.category.update', $data);
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
        // data detail...
        $data['category']           = BlogCategory::where('uuid', $id)->first();
        $oldName                    = $data['category']->name;

        // data input...
        $name                       = $request->name;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');

        // validation logic...
        $oldName                    !== $name ? $uName = "unique:blog_categories" : $uName = "";

        // validation...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', $uName],
        ]);

        // insert to table...
        $data = [
            'name'                  => $name,
            'slug'                  => $slug,
        ];
        BlogCategory::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" diubah!',
            'alert'                 => 'success',
            'icon'                  => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.blog.category.index')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['category']           = BlogCategory::where('uuid', $id)->first();
        $oldId                      = $data['category']->id;
        $oldName                    = $data['category']->name;
        $message                    = $oldName;

        // delete data on table..
        BlogCategory::where('uuid', $id)->delete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.blog.category.index')->with($flashData);
    }
}
