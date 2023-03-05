<?php

namespace App\Http\Controllers\Private\Developer;

use App\Models\UserMenu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'menus' => UserMenu::where('parent_id', 0)->orderBy('order')->get(),
        ];
        return view('private.user-menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.user-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data input
        $parent_id          = 0;
        $order              = $request->order;
        $name               = $request->name;
        $icon               = $request->icon;
        $prefix             = strtolower($request->prefix);
        $url                = $request->url;
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';
        $uuid               = Str::uuid();

        // validation
        $validatedData      = $request->validate([
            'order'         => ['required', 'max:255'],
            'name'          => ['required', 'max:255'],
            'icon'          => ['required', 'max:255'],
            'prefix'        => ['required', 'max:255'],
        ]);

        // masukkan ke table
        $data = [
            'uuid'          => $uuid,
            'parent_id'     => $parent_id,
            'order'         => $order,
            'name'          => $name,
            'slug'          => $slug,
            'icon'          => $icon,
            'prefix'        => $prefix,
            'url'           => $url,
        ];
        UserMenu::create($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" ditambahkan',
            'alert'         => 'primary',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function show(UserMenu $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMenu $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMenu $menu)
    {
        // data detail 
        $id                 = $menu->uuid;

        // data input
        $order              = $request->order;
        $name               = $request->name;
        $icon               = $request->icon;
        $prefix             = strtolower($request->prefix);
        $url                = $request->url;
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';

        // validation
        $validatedData      = $request->validate([
            'order'         => ['required', 'max:255'],
            'name'          => ['required', 'max:255'],
            'icon'          => ['required', 'max:255'],
            'prefix'        => ['required', 'max:255'],
        ]);

        // input to table
        $data = [
            'order'         => $order,
            'name'          => $name,
            'slug'          => $slug,
            'icon'          => $icon,
            'prefix'        => $prefix,
            'url'           => $url,
        ];
        UserMenu::where('uuid', $id)->update($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" diubah!',
            'alert'         => 'success',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMenu $menu)
    {
        $id                 = $menu->id;
        $message            = $menu->name;
        UserMenu::destroy($id);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }


    public function create_sub(UserMenu $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu.create-sub', $data);
    }

    public function store_sub(Request $request, UserMenu $menu)
    {
        $parent_id          = $menu->id;
        $order              = $request->order;
        $name               = $request->name;
        $icon               = $request->icon;
        $prefix             = strtolower($request->prefix);
        $url                = $request->url;
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';
        $uuid               = Str::uuid();

        $validatedData      = $request->validate([
            'order'         => ['required', 'max:255'],
            'name'          => ['required', 'max:255'],
            'icon'          => ['required', 'max:255'],
            'prefix'        => ['required', 'max:255'],
        ]);

        $data = [
            'uuid'          => $uuid,
            'parent_id'     => $parent_id,
            'order'         => $order,
            'name'          => $name,
            'slug'          => $slug,
            'icon'          => $icon,
            'prefix'        => $prefix,
            'url'           => $url,
        ];

        UserMenu::create($data);
        $flashData = [
            'message'       => 'Data "' . $message . '" ditambahkan',
            'alert'         => 'primary',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }
}
