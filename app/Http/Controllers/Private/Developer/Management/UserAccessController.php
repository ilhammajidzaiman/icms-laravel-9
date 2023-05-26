<?php

namespace App\Http\Controllers\Private\Developer\Management;

use App\Models\UserLevel;
use App\Models\UserAccessChild;
use App\Models\UserAccessParent;
use App\Models\UserMenuParent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['levels']             = UserLevel::orderBy('id')->get();
        return view('admin-lte.private.developer.management.user-access.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAccess $userAccess
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['level']              = UserLevel::where('slug', $id)->first();
        return view('admin-lte.private.developer.management.user-access.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAccess $userAccess
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['level']              = UserLevel::where('slug', $id)->first();
        $data['menus']              = UserMenuParent::orderBy('order')->get();
        return view('admin-lte.private.developer.management.user-access.update', $data);
    }

    public function updateParent($level, $parent)
    {
        $userAccess = UserAccessParent::where('user_level_id', $level)->where('user_menu_parent_id', $parent)->first();
        if ($userAccess) :
            UserAccessParent::where('user_level_id', $level)->where('user_menu_parent_id', $parent)->delete();
        else :
            $data =
                [
                    'user_level_id'             => $level,
                    'user_menu_parent_id'       => $parent,
                ];
            UserAccessParent::create($data);
        endif;
    }

    public function updateChild($level, $parent, $child)
    {
        $userChild = UserAccessChild::where('user_level_id', $level)->where('user_menu_parent_id', $parent)->where('user_menu_child_id', $child)->first();
        if ($userChild) :
            UserAccessChild::where('user_level_id', $level)->where('user_menu_parent_id', $parent)->where('user_menu_child_id', $child)->delete();
        else :
            $data =
                [
                    'user_level_id'             => $level,
                    'user_menu_parent_id'       => $parent,
                    'user_menu_child_id'        => $child,
                ];
            UserAccessChild::create($data);
        endif;
    }
}
