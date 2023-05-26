<?php

namespace App\Http\Controllers\Private\Developer\Blog;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog\BlogStatus;
use App\Http\Controllers\Controller;

class BlogStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['statuses']         = BlogStatus::orderByDesc('id')->get();
        return view('admin-lte.private.developer.blog.status.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-lte.private.developer.blog.status.create');
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
        $color                      = $request->color;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');
        $uuid                       = Str::uuid();

        // validation...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', 'unique:blog_statuses'],
        ]);

        // insert to table...
        $data = [
            'uuid'                  => $uuid,
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        BlogStatus::create($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" ditambahkan!',
            'alert'                 => 'primary',
            'icon'                  => 'check',
        ];
        return redirect(route('developer.blog.status.index'))->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['status']           = BlogStatus::where('slug', $id)->first();
        return view('admin-lte.private.developer.blog.status.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['status']           = BlogStatus::where('slug', $id)->first();
        return view('admin-lte.private.developer.blog.status.update', $data);
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
        $data['status']             = BlogStatus::where('slug', $id)->first();
        $oldName                    = $data['status']->name;

        // data input...
        $name                       = $request->name;
        $color                      = $request->color;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');

        // validation logic...
        $oldName                    !== $name ? $uName = "unique:blog_statuses" : $uName = "";

        // validation...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', $uName],
        ]);

        // insert to table...
        $data = [
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        BlogStatus::where('slug', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" diubah!',
            'alert'                 => 'success',
            'icon'                  => 'edit',
        ];
        return redirect(route('developer.blog.status.index'))->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // data detail...
        $data['category']           = BlogStatus::where('slug', $id)->first();
        $oldId                      = $data['category']->id;
        $oldName                    = $data['category']->name;
        $message                    = $oldName;

        // delete data on table..
        BlogStatus::destroy($oldId);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus!',
            'alert'                 => 'danger',
            'icon'                  => 'trash',
        ];
        return redirect(route('developer.blog.status.index'))->with($flashData);
    }
}
