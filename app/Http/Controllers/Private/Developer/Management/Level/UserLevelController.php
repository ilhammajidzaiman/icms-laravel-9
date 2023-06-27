<?php

namespace App\Http\Controllers\Private\Developer\Management\Level;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserLevel;

class UserLevelController extends Controller
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
        $data['count']              = UserLevel::onlyTrashed()->get()->count();
        return view('private.level.developer.management.level.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.level.developer.management.level.create');
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
            'name'                  => ['required', 'max:255', 'unique:user_levels'],
        ]);

        // insert to table...       
        $data = [
            'uuid'                  => $uuid,
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        UserLevel::create($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" ditambahkan!',
            'alert'                 => 'primary',
            'icon'                  => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.management.user.level.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['level']              = UserLevel::where('uuid', $id)->first();
        return view('private.level.developer.management.level.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['level']              = UserLevel::where('uuid', $id)->first();
        return view('private.level.developer.management.level.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // data detail...
        $data['level']              = UserLevel::where('uuid', $id)->first();
        $oldName                    = $data['level']->name;

        // data input...
        $name                       = $request->name;
        $color                      = $request->color;
        $message                    = $name;
        $slug                       = Str::slug($name, '-');

        // validation logic...
        $oldName                    !== $name ? $uName = "unique:user_statuses" : $uName = "";

        // validation...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255', $uName],
        ]);

        // insert to table...
        $data = [
            'name'                  => $name,
            'slug'                  => $slug,
            'color'                 => $color,
        ];
        UserLevel::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" diubah!',
            'alert'                 => 'success',
            'icon'                  => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.management.user.level.index')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['level']              = UserLevel::where('uuid', $id)->first();
        $message                    = $data['level']->name;

        // delete data on table...
        UserLevel::where('uuid', $id)->delete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.management.user.level.index')->with($flashData);
    }
}
