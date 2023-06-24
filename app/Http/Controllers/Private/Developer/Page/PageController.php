<?php

namespace App\Http\Controllers\Private\Developer\Page;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                         = request(['search']);
        $data['pages']                  = Page::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        $data['count']                  = Page::onlyTrashed()->orderByDesc('id')->get()->count();
        return view('private.developer.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.developer.page.create');
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
        $title                          = $request->title;
        $content                        = $request->content;
        $message                        = $title;
        $uuid                           = Str::uuid();
        $slug                           = Str::slug($title, '-');

        // validation...
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:255', 'unique:pages'],
            'content'                   => ['required'],
        ]);

        // insert to table...
        $data = [
            'uuid'                      => $uuid,
            'title'                     => $title,
            'slug'                      => $slug,
            'content'                   => $content,
        ];
        Page::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.page.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['page']                   = Page::where('uuid', $id)->first();
        return view('private.developer.page.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page']                   = Page::where('uuid', $id)->first();
        return view('private.developer.page.update', $data);
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
        // detail data
        $data['page']                   = Page::where('uuid', $id)->first();
        $oldTitle                       = $data['page']->title;

        // data input...
        $title                          = $request->title;
        $content                        = $request->content;
        $message                        = $title;
        $slug                           = Str::slug($title, '-');

        // validation logic
        $oldTitle                       !== $title ? $uTitle = "unique:pages" : $uTitle = "";

        // validation
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:255', $uTitle],
            'content'                   => ['required'],
        ]);

        // insert to table...
        $data = [
            'title'                     => $title,
            'slug'                      => $slug,
            'content'                   => $content,
        ];
        Page::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.page.index')->with($flashData);
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
        $data['page']                   = Page::where('uuid', $id)->first();
        $message                        = $data['page']->title;

        // delete data on table...
        Page::where('uuid', $id)->delete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.page.index')->with($flashData);
    }
}
