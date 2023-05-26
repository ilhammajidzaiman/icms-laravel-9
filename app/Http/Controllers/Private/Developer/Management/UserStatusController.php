<?php

namespace App\Http\Controllers\Private\Developer\Management;

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
        $data['statuses']           = UserStatus::orderByDesc('id')->get();
        return view('admin-lte.private.developer.management.user-status.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-lte.private.developer.management.user-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data input...
        $name               = $request->name;
        $color              = $request->color;
        $message            = $name;
        $slug               = Str::slug($name, '-');
        $uuid               = Str::uuid();

        // validation...
        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255', 'unique:user_statuses'],
            'color'         => ['required', 'max:255'],
        ]);

        // insert to table...
        $data = [
            'uuid'          => $uuid,
            'name'          => $name,
            'slug'          => $slug,
            'color'         => $color,
        ];
        UserStatus::create($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" ditambahkan!',
            'alert'                 => 'primary',
            'icon'                  => 'check',
        ];
        return redirect(route('developer.management.user.status.index'))->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['status']             = UserStatus::where('slug', $id)->first();
        return view('admin-lte.private.developer.management.user-status.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['status']             = UserStatus::where('slug', $id)->first();
        return view('admin-lte.private.developer.management.user-status.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // data detail...
        $data['status']             = UserStatus::where('slug', $id)->first();
        $oldName                    = $data['status']->name;

        // data input...
        $name                       = $request->name;
        $color                      = $request->color;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');

        // validation logic...
        $oldName                    !== $name ? $uName = "unique:user_statuses" : $uName = "";

        // validation
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', $uName],
            'color'                 => ['required', 'max:255'],
        ]);

        // insert to table...
        $data = [
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        UserStatus::where('slug', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" diubah!',
            'alert'                 => 'success',
            'icon'                  => 'edit',
        ];
        return redirect(route('developer.management.user.status.index'))->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // data detail...
        $data['status']             = UserStatus::where('slug', $id)->first();
        $oldId                      = $data['status']->id;
        $message                    = $data['status']->name;

        // delete data on table...
        UserStatus::destroy($oldId);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus!',
            'alert'                 => 'danger',
            'icon'                  => 'trash',
        ];
        return redirect(route('developer.management.user.status.index'))->with($flashData);
    }
}
