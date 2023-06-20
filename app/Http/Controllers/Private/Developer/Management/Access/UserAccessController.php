<?php

namespace App\Http\Controllers\Private\Developer\Management\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserLevel;
use App\Models\Management\UserMenuParent;
use App\Models\Management\UserAccessChild;
use App\Models\Management\UserAccessParent;

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                     = request(['search']);
        $data['levels']             = UserLevel::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.developer.management.access.index', $data);
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
        return view('private.developer.management.access.show', $data);
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
        return view('private.developer.management.access.update', $data);
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
