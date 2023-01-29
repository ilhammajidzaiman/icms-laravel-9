<?php

namespace App\Http\Controllers\Private\Admin;

use App\Models\UserMenu;
use App\Models\UserLevel;
use App\Models\UserAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'levels'        => UserLevel::orderBy('id')->get(),
        ];
        return view('private.menu-access.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAccess $userAccess
     * @return \Illuminate\Http\Response
     */
    public function show(UserLevel $access)
    {
        $data = [
            'level'         => $access,
        ];
        return view('private.menu-access.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAccess $userAccess
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLevel $access)
    {
        $data = [
            'level'         => $access,
            'menus'         => UserMenu::where('parent_id', 0)->orderByDesc('id')->get(),
        ];
        return view('private.menu-access.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAccess $userAccess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLevel $access)
    {
        // detail data
        $oldId              = $access->id;
        $oldLevel           = $access->name;

        // data input
        $menu               = $request->menu;
        $message            = $oldLevel;

        // delete data on table accesses
        UserAccess::where('level_id', $oldId)->delete();

        // insert menu to table accesses
        if ($menu) :
            $data2 = [];
            foreach ($menu as $key) :
                $data2[] =
                    [
                        'level_id'      => $oldId,
                        'menu_id'       => $key,
                    ];
            endforeach;
            UserAccess::insert($data2);
        endif;

        $flashData = [
            'message'       => 'Data "' . $message . '" diubah',
            'alert'         => 'success',
        ];
        return redirect('/admin/master/access')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAccess $userAccess
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccess $access)
    {
        //
    }
}
