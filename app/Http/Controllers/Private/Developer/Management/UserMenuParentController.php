<?php

namespace App\Http\Controllers\Private\Developer\Management;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserMenuParent;
use App\Http\Controllers\Controller;

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
        return view('admin-lte.private.developer.management.user-menu-parent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-lte.private.developer.management.user-menu-parent.create');
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
            'icon'                      => 'check',
        ];
        return redirect(route('developer.management.user.menu.parent.index'))->with($flashData);
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
        return view('admin-lte.private.developer.management.user-menu-parent.show', $data);
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
        return view('admin-lte.private.developer.management.user-menu-parent.update', $data);
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
            'icon'                      => 'edit',
        ];
        return redirect(route('developer.management.user.menu.parent.index'))->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
            'icon'                      => 'trash',
        ];
        return redirect(route('developer.management.user.menu.parent.index'))->with($flashData);
    }
}
