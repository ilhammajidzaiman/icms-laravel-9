<?php

namespace App\Http\Controllers\Private\Developer\NavMenu;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NavMenu\NavMenuChild;
use App\Models\NavMenu\NavMenuParent;

class NavMenuChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['navMenuParent']              = NavMenuParent::where('uuid', $id)->first();
        return view('private.developer.nav-menu.child.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // data detail...
        $data['menuParent']             = NavMenuParent::where('uuid', $id)->first();

        // data input...
        $parent                         = $data['menuParent']->id;
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
            'nav_menu_parent_id'        => $parent,
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'url'                       => $url,
        ];
        NavMenuChild::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
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
        $data['navMenuChild']              = NavMenuChild::where('uuid', $id)->first();
        return view('private.developer.nav-menu.child.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['navMenuChild']              = NavMenuChild::where('uuid', $id)->first();
        return view('private.developer.nav-menu.child.update', $data);
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

        // input to table...
        $data = [
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'url'                       => $url,
        ];
        NavMenuChild::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah!',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
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
        $data['navMenuChild']           = NavMenuChild::where('uuid', $id)->first();
        $id                             = $data['navMenuChild']->id;
        $message                        = $data['navMenuChild']->name;

        // delete data on table...
        NavMenuChild::destroy($id);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect(route($request->segment(1) . '.nav-menu.parent.index'))->with($flashData);
    }
}
