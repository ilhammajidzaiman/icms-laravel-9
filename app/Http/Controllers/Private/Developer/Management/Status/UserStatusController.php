<?php

namespace App\Http\Controllers\Private\Developer\Management\Status;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserStatus;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                     = request(['search']);
        $data['statuses']           = UserStatus::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        $data['count']              = UserStatus::onlyTrashed()->get()->count();
        return view('private.developer.management.status.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.developer.management.status.create');
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
        $name                       = $request->name;
        $color                      = $request->color;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');
        $uuid                       = Str::uuid();

        // validation...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', 'unique:user_statuses'],
        ]);

        // insert to table...
        $data = [
            'uuid'                  => $uuid,
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        UserStatus::create($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" ditambahkan!',
            'alert'                 => 'primary',
            'icon'                  => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.management.user.status.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['status']             = UserStatus::where('uuid', $id)->first();
        return view('private.developer.management.status.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['status']             = UserStatus::where('uuid', $id)->first();
        return view('private.developer.management.status.update', $data);
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
        $data['status']             = UserStatus::where('uuid', $id)->first();
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
        ]);

        // insert to table...
        $data = [
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        UserStatus::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" diubah!',
            'alert'                 => 'success',
            'icon'                  => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.management.user.status.index')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserStatus  $userrStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['status']             = UserStatus::where('uuid', $id)->first();
        $message                    = $data['status']->name;

        // delete data on table...
        UserStatus::where('uuid', $id)->delete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.management.user.status.index')->with($flashData);
    }
}
