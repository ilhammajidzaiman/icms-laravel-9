<?php

namespace App\Http\Controllers\Private\Developer\Management\User;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserLevel;
use Illuminate\Support\Facades\Hash;
use App\Models\Management\UserStatus;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                         = request(['search']);
        $data['users']                  = User::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        $data['count']                  = User::onlyTrashed()->get()->count();
        return view('private.level.developer.management.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['statuses']               = UserStatus::orderBy('id')->get();
        $data['levels']                 = UserLevel::orderByDesc('id')->get();
        return view('private.level.developer.management.user.create', $data);
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
        $name                           = $request->name;
        $username                       = $request->username;
        $email                          = $request->email;
        $status                         = $request->status;
        $level                          = $request->level;
        $file                           = $request->file('file');
        $message                        = $request->name;
        $uuid                           = Str::uuid();
        $slug                           = Str::slug($name, '-');
        $password                       = Hash::make($request->password);
        $folder                         = 'user/' . date('Y/m/');
        $default                        = 'default-user.svg';

        // validation input...
        $validatedData                  = $request->validate([
            'name'                      => ['required', 'max:255'],
            'username'                  => ['required', 'max:255', 'unique:users'],
            'email'                     => ['required', 'max:255', 'unique:users'],
            'password'                  => ['required', 'max:255', 'min:6', 'same:confirmation'],
            'confirmation'              => ['required', 'max:255', 'min:6', 'same:password'],
            'status'                    => ['required', 'max:255'],
            'level'                     => ['required', 'max:255'],
        ]);
        // upload file to storage...
        if ($file) :
            // manually specify a filename...
            $dateTime                   = date('YmdHis');
            $uniqId                     = uniqid();
            $fileExtension              = $file->extension();
            $path                       = $folder;
            $fileName                   = $dateTime . '-' . $uniqId . '.' . $fileExtension;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $path                       = null;
            $fileName                   = $default;
        endif;

        // insert data to table..
        $data = [
            'user_level_id'             => $level,
            'user_status_id'            => $status,
            'uuid'                      => $uuid,
            'password'                  => $password,
            'username'                  => $username,
            'email'                     => $email,
            'name'                      => $name,
            'slug'                      => $slug,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        User::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.management.user.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user']                   = User::where('uuid', $id)->first();
        return view('private.level.developer.management.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user']                   = User::where('uuid', $id)->first();
        $data['statuses']               = UserStatus::orderBy('id')->get();
        $data['levels']                 = UserLevel::orderByDesc('id')->get();
        return view('private.level.developer.management.user.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // data detail...
        $data['user']                   = User::where('uuid', $id)->first();
        $oldUsername                    = $data['user']->username;
        $oldEmail                       = $data['user']->email;
        $oldPath                        = $data['user']->path;
        $oldFile                        = $data['user']->file;

        // data input...
        $name                           = $request->name;
        $username                       = $request->username;
        $email                          = $request->email;
        $status                         = $request->status;
        $level                          = $request->level;
        $file                           = $request->file('file');
        $message                        = $request->name;
        $slug                           = Str::slug($name, '-');
        $folder                         = 'user/' . date('Y/m/');
        $default                        = 'default-user.svg';

        // validation logic...
        $oldUsername                    !== $username ? $uUsername = "unique:users" : $uUsername = "";
        $oldEmail                       !== $email ? $uEmail = "unique:users" : $uEmail = "";

        // validation input...
        $validatedData                  = $request->validate([
            'name'                      => ['required', 'max:255'],
            'username'                  => ['required', 'max:255', $uUsername],
            'email'                     => ['required', 'max:255', $uEmail],
            'status'                    => ['required', 'max:255'],
            'level'                     => ['required', 'max:255'],
        ]);

        // upload file to storage...
        if ($file) :
            // delete old file on storage before upload new file...
            if ($oldFile !== $default) :
                Storage::delete($oldPath . $oldFile);
            endif;

            // manually specify a filename...
            $dateTime                   = date('YmdHis');
            $uniqId                     = uniqid();
            $fileExtension              = $file->extension();
            $path                       = $folder;
            $fileName                   = $dateTime . '-' . $uniqId . '.' . $fileExtension;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $path                       = $oldPath;
            $fileName                   = $oldFile;
        endif;

        // insert data to table...
        $data = [
            'user_level_id'             => $level,
            'user_status_id'            => $status,
            'username'                  => $username,
            'email'                     => $email,
            'name'                      => $name,
            'slug'                      => $slug,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        User::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.management.user.index')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['user']                   = User::where('uuid', $id)->first();
        $message                        = $data['user']->name;

        // delete data on table...
        User::where('uuid', $id)->delete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.management.user.index')->with($flashData);
    }

    public function password($id)
    {
        $data['user']                   = User::where('uuid', $id)->first();
        return view('private.level.developer.management.user.password', $data);
    }

    public function reset(Request $request, $id)
    {
        // data input...
        $password                       = Hash::make($request->password);

        // validation input...
        $validatedData                  = $request->validate([
            'password'                  => ['required', 'max:255', 'min:6', 'same:confirmation'],
            'confirmation'              => ['required', 'max:255', 'min:6', 'same:password'],
        ]);

        // insert data to table...
        $data = [
            'password'                  => $password,
        ];
        User::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Password berhasil diubah!',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-key',
        ];
        return redirect()->route($request->segment(1) . '.management.user.edit', $id)->with($flashData);
    }
}
