<?php

namespace App\Http\Controllers\Private\Developer\NavMenu;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NavMenu\NavMenuParent;

class NavMenuParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['navMenuParents']         = NavMenuParent::orderBy('order')->get();
        return view('private.level.developer.nav-menu.parent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.level.developer.nav-menu.parent.create');
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
        $order                          = $request->order;
        $name                           = $request->name;
        $url                            = Str::replace(' ', '', $request->url);
        $message                        = $name;
        $slug                           = Str::slug($name, '-');
        $uuid                           = Str::uuid();

        // validation...
        $validatedData                  = $request->validate([
            'order'                     => ['required', 'max:255'],
            'name'                      => ['required', 'max:255'],
        ]);

        // insert to table...
        $data = [
            'uuid'                      => $uuid,
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'url'                       => $url,
        ];
        NavMenuParent::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'bi bi-check2',
        ];
        return redirect(route($request->segment(1) . '.nav-menu.parent.index'))->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['navMenuParent']         = NavMenuParent::where('uuid', $id)->first();
        return view('private.level.developer.nav-menu.parent.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['navMenuParent']         = NavMenuParent::where('uuid', $id)->first();
        return view('private.level.developer.nav-menu.parent.update', $data);
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
        // data input...
        $order                          = $request->order;
        $name                           = $request->name;
        $url                            = Str::replace(' ', '', $request->url);
        $message                        = $name;
        $slug                           = Str::slug($name, '-');

        // validation...
        $validatedData                  = $request->validate([
            'order'                     => ['required', 'max:255'],
            'name'                      => ['required', 'max:255'],
        ]);

        // insert to table...
        $data = [
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'url'                       => $url,
        ];
        NavMenuParent::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah!',
            'alert'                     => 'success',
            'icon'                      => 'bi bi-pencil-square',
        ];
        return redirect(route($request->segment(1) . '.nav-menu.parent.index'))->with($flashData);
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
        $data['navMenuParent']          = NavMenuParent::where('uuid', $id)->first();
        $id                             = $data['navMenuParent']->id;
        $message                        = $data['navMenuParent']->name;
        NavMenuParent::destroy($id);

        // flashdata
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'bi bi-trash3',
        ];
        return redirect(route($request->segment(1) . '.nav-menu.parent.index'))->with($flashData);
    }
}
