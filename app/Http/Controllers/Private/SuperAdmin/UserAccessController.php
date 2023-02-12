<?php

namespace App\Http\Controllers\Private\SuperAdmin;

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
        return redirect('/superadmin/master/access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('/superadmin/master/access');
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
            'menus'         => UserMenu::where('parent_id', 0)->orderBy('order')->get(),
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
        return redirect('/superadmin/master/access')->with($flashData);
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











    public function accesslevel(UserLevel $access)
    {
        $data = [
            'level'         => $access,
            'menus'         => UserMenu::where('parent_id', 0)->orderBy('order')->get(),
        ];
        return view('private.menu-access.access', $data);
    }


    public function ubah($id1, $id2, $id3)
    {
        $userAccess = UserAccess::where('level_id', $id1)->where('menu_id', $id2)->where('order', $id3)->first();
        if ($userAccess) :
            UserAccess::where('level_id', $id1)->where('menu_id', $id2)->where('order', $id3)->delete();
        else :
            $data =
                [
                    'level_id'      => $id1,
                    'menu_id'       => $id2,
                    'order'         => $id3,
                ];
            UserAccess::insert($data);
        endif;
    }
}
