<?php

namespace App\Http\Controllers\Private\Developer\Management\Menu\Parent;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserMenuParent;

class UserMenuParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menuParents']            = UserMenuParent::orderBy('order')->get();
        return view('private.developer.management.menu.parent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.developer.management.menu.parent.create');
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
        $icon                           = $request->icon;
        $url                            = $request->url;
        $message                        = $name;
        $prefix                         = str::lower($request->prefix);
        $slug                           = Str::slug($name, '-');
        $uuid                           = Str::uuid();

        // validation...
        $validatedData                  = $request->validate([
            'order'                     => ['required', 'max:255'],
            'name'                      => ['required', 'max:255'],
            'icon'                      => ['required', 'max:255'],
            'prefix'                    => ['required', 'max:255'],
        ]);

        // insert to table...
        $data = [
            'uuid'                      => $uuid,
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'icon'                      => $icon,
            'prefix'                    => $prefix,
            'url'                       => $url,
        ];
        UserMenuParent::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect(route($request->segment(1) . '.management.user.menu.parent.index'))->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['menuParent']             = UserMenuParent::where('uuid', $id)->first();
        return view('private.developer.management.menu.parent.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['menuParent']             = UserMenuParent::where('uuid', $id)->first();
        return view('private.developer.management.menu.parent.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // data input...
        $order                          = $request->order;
        $name                           = $request->name;
        $icon                           = $request->icon;
        $url                            = $request->url;
        $message                        = $name;
        $prefix                         = str::lower($request->prefix);
        $slug                           = Str::slug($name, '-');

        // validation...
        $validatedData                  = $request->validate([
            'order'                     => ['required', 'max:255'],
            'name'                      => ['required', 'max:255'],
            'icon'                      => ['required', 'max:255'],
            'prefix'                    => ['required', 'max:255'],
        ]);

        // insert to table...
        $data = [
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'icon'                      => $icon,
            'prefix'                    => $prefix,
            'url'                       => $url,
        ];
        UserMenuParent::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah!',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect(route($request->segment(1) . '.management.user.menu.parent.index'))->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['menuParent']             = UserMenuParent::where('uuid', $id)->first();
        $id                             = $data['menuParent']->id;
        $message                        = $data['menuParent']->name;
        UserMenuParent::destroy($id);

        // flashdata
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect(route($request->segment(1) . '.management.user.menu.parent.index'))->with($flashData);
    }
}
