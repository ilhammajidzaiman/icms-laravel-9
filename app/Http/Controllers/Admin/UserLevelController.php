<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'controller'    => 'level',
            'title'         => 'level',
            'levels'        => UserLevel::orderByDesc('id')->get(),
        ];
        return view('private.level.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name               = $request->name;
        $slug               = Str::slug($name, '-') . '.html';
        $uuid               = Str::uuid();
        $message            = $name;

        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255', 'unique:user_levels']
        ]);
        $data = [
            'uuid'          => $uuid,
            'name'          => $name,
            'slug'          => $slug,
        ];
        UserLevel::create($data);
        $flashData = [
            'message'       => 'Data "' . $message . '" ditambahkan!',
            'alert'         => 'primary',
        ];
        return redirect('/admin/master/level')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function show(UserLevel $level)
    {
        $data = [
            'level'         => $level,
        ];
        return view('private.level.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLevel $level)
    {
        $data = [
            'level'         => $level,
        ];
        return view('private.level.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLevel $level)
    {
        // data detail
        $oldSlug            = $level->slug;
        $oldName            = $level->name;

        // data input
        $name               = $request->name;
        $slug               = Str::slug($name, '-') . '.html';
        $message            = $name;

        // validation logic
        $oldName            !== $name ? $uName = "unique:user_statuses" : $uName = "";

        // validation
        $validatedData      = $request->validate([
            'name'         => ['required', 'max:255', $uName]
        ]);

        // insert to table
        $data = [
            'name'          => $name,
            'slug'          => $slug,
        ];
        UserLevel::where('slug', $oldSlug)->update($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" diubah!',
            'alert'         => 'success',
        ];
        return redirect('/admin/master/level')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLevel $level)
    {
        // data detail
        $oldId              = $level->id;
        $oldName            = $level->name;
        $message            = $oldName;

        // delete data on table
        UserLevel::destroy($oldId);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/admin/master/level')->with($flashData);
    }
}
