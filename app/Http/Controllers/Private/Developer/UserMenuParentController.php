<?php

namespace App\Http\Controllers\Private\Developer;

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
        $data = [
            'menus' => UserMenuParent::orderBy('order')->get(),
        ];
        return view('private.user-menu-parent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.user-menu-parent.create');
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
        $order              = $request->order;
        $name               = $request->name;
        $icon               = $request->icon;
        $url                = $request->url;
        $message            = $name;
        $prefix             = str::lower($request->prefix);
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
            'order'         => $order,
            'name'          => $name,
            'slug'          => $slug,
            'icon'          => $icon,
            'prefix'        => $prefix,
            'url'           => $url,
        ];
        UserMenuParent::create($data);

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
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function show(UserMenuParent $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu-parent.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMenuParent $menu)
    {
        $data = [
            'menu'          => $menu,
        ];
        return view('private.user-menu-parent.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMenuParent $menu)
    {
        // data detail 
        $id                 = $menu->uuid;

        // data input
        $order              = $request->order;
        $name               = $request->name;
        $icon               = $request->icon;
        $url                = $request->url;
        $message            = $name;
        $prefix             = str::lower($request->prefix);
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
        UserMenuParent::where('uuid', $id)->update($data);

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
     * @param  \App\Models\UserMenuParent  $userMenuParent
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMenuParent $menu)
    {
        $id                 = $menu->id;
        $message            = $menu->name;
        UserMenuParent::destroy($id);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/developer/management/menu')->with($flashData);
    }
}
