<?php

namespace App\Http\Controllers\Private\Developer\Management\Menu\Child;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserMenuChild;
use App\Models\Management\UserMenuParent;

class UserMenuChildController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['menuParent']             = UserMenuParent::where('uuid', $id)->first();
        return view('private.level.developer.management.menu.child.create', $data);
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
        $data['menuParent']             = UserMenuParent::where('uuid', $id)->first();

        // data input...
        $parent                         = $data['menuParent']->id;
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
            'user_menu_parent_id'       => $parent,
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'icon'                      => $icon,
            'prefix'                    => $prefix,
            'url'                       => $url,
        ];
        UserMenuChild::create($data);

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
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['menuChild']              = UserMenuChild::where('uuid', $id)->first();
        return view('private.level.developer.management.menu.child.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['menuChild']              = UserMenuChild::where('uuid', $id)->first();
        return view('private.level.developer.management.menu.child.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMenuChild  $userMenuChild
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
        $uuid                           = Str::uuid();

        // validation...
        $validatedData                  = $request->validate([
            'order'                     => ['required', 'max:255'],
            'name'                      => ['required', 'max:255'],
            'icon'                      => ['required', 'max:255'],
            'prefix'                    => ['required', 'max:255'],
        ]);

        // input to table...
        $data = [
            'order'                     => $order,
            'name'                      => $name,
            'slug'                      => $slug,
            'icon'                      => $icon,
            'prefix'                    => $prefix,
            'url'                       => $url,
        ];
        UserMenuChild::where('uuid', $id)->update($data);

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
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['menuChild']              = UserMenuChild::where('uuid', $id)->first();
        $id                             = $data['menuChild']->id;
        $message                        = $data['menuChild']->name;

        // delete data on table...
        UserMenuChild::destroy($id);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect(route($request->segment(1) . '.management.user.menu.parent.index'))->with($flashData);
    }
}
