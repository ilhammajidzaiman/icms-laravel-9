<?php

namespace App\Http\Controllers\Private\Admin;

use App\Models\UserStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'statuses'    => UserStatus::orderByDesc('id')->get(),
        ];
        return view('private.user-status.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.user-status.create');
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
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';
        $uuid               = Str::uuid();

        // validation
        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255', 'unique:user_statuses']
        ]);

        // insert to table 
        $data = [
            'uuid'          => $uuid,
            'name'          => $name,
            'slug'          => $slug,
        ];
        UserStatus::create($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" ditambahkan!',
            'alert'         => 'primary',
        ];
        return redirect('/admin/management/status')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function show(UserStatus $status)
    {
        $data = [
            'status'        => $status,
        ];
        return view('private.user-status.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(UserStatus $status)
    {
        $data = [
            'status'        => $status,
            // 'status'        => $Status->where('slug', $id)->first(),
        ];
        return view('private.user-status.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserStatus $status)
    {
        // data detail
        $oldSlug            = $status->slug;
        $oldName            = $status->name;

        // data input
        $name               = $request->name;
        $message            = $name;
        $slug               = Str::slug($name, '-') . '.html';

        // validation logic
        $oldName            !== $name ? $uName = "unique:user_statuses" : $uName = "";

        // validation
        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255', $uName]
        ]);

        // insert to table statuses
        $data = [
            'name'          => $name,
            'slug'          => $slug,
        ];
        UserStatus::where('slug', $oldSlug)->update($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" diubah!',
            'alert'         => 'success',
        ];
        return redirect('/admin/management/status')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserStatus $status)
    {
        // data detail
        $oldId              = $status->id;
        $oldName            = $status->name;
        $message            = $oldName;

        // delete data on table
        UserStatus::destroy($oldId);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/admin/management/status')->with($flashData);
    }
}
