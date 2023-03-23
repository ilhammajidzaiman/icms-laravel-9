<?php

namespace App\Http\Controllers\Private\Developer;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserMenuChild;
use App\Models\UserMenuParent;
use App\Http\Controllers\Controller;

class UserMenuChildController extends Controller
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
    public function create(UserMenuParent $menu)
    {
        $data = [
            'menu'                  => $menu,
        ];
        return view('private.user-menu-child.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserMenuParent $menu)
    {
        $parent                     = $menu->id;
        $order                      = $request->order;
        $name                       = $request->name;
        $icon                       = $request->icon;
        $url                        = $request->url;
        $message                    = $name;
        $prefix                     = str::lower($request->prefix);
        $slug                       = Str::slug($name, '-') . '.html';
        $uuid                       = Str::uuid();

        $validatedData              = $request->validate([
            'order'                 => ['required', 'max:255'],
            'name'                  => ['required', 'max:255'],
            'icon'                  => ['required', 'max:255'],
            'prefix'                => ['required', 'max:255'],
        ]);

        $data = [
            'uuid'                  => $uuid,
            'user_menu_parent_id'   => $parent,
            'order'                 => $order,
            'name'                  => $name,
            'slug'                  => $slug,
            'icon'                  => $icon,
            'prefix'                => $prefix,
            'url'                   => $url,
        ];

        UserMenuChild::create($data);
        $flashData = [
            'message'               => 'Data "' . $message . '" ditambahkan',
            'alert'                 => 'primary',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function show(UserMenuChild $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu-child.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMenuChild $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu-child.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMenuChild $menu)
    {
        // data detail 
        $id                         = $menu->uuid;

        // data input
        $order                      = $request->order;
        $name                       = $request->name;
        $icon                       = $request->icon;
        $url                        = $request->url;
        $message                    = $name;
        $prefix                     = str::lower($request->prefix);
        $slug                       = Str::slug($name, '-') . '.html';
        $uuid                       = Str::uuid();

        // validation
        $validatedData              = $request->validate([
            'order'                 => ['required', 'max:255'],
            'name'                  => ['required', 'max:255'],
            'icon'                  => ['required', 'max:255'],
            'prefix'                => ['required', 'max:255'],
        ]);

        // input to table
        $data = [
            'order'                 => $order,
            'name'                  => $name,
            'slug'                  => $slug,
            'icon'                  => $icon,
            'prefix'                => $prefix,
            'url'                   => $url,
        ];
        UserMenuChild::where('uuid', $id)->update($data);

        // flashdata
        $flashData = [
            'message'               => 'Data "' . $message . '" diubah!',
            'alert'                 => 'success',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMenuChild  $userMenuChild
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMenuChild $menu)
    {
        $id                 = $menu->id;
        $message            = $menu->name;
        UserMenuChild::destroy($id);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }
}
