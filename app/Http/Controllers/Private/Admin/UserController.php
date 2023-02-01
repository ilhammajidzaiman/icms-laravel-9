<?php

namespace App\Http\Controllers\Private\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserLevel;
use App\Models\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        $search             = request(['search']);
        $data = [
            'users'         => User::filter($search)->orderByDesc('id')->paginate(20)->withQueryString(),
        ];
        return view('private.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'statuses'      => UserStatus::orderBy('id')->get(),
            'levels'        => UserLevel::orderByDesc('id')->get(),
        ];
        return view('private.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data input
        $name               = $request->name;
        $username           = $request->username;
        $email              = $request->email;
        $status             = $request->status;
        $level              = $request->level;
        $file               = $request->file('file');
        $message            = $name;
        $uuid               = Str::uuid();
        $password           = Hash::make($request->password);
        $folder             = 'user';
        $default            = 'default-user.svg';

        // validation input
        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255'],
            'username'      => ['required', 'max:255', 'unique:users'],
            'email'         => ['required', 'max:255', 'unique:users'],
            'password'      => ['required', 'min:6', 'same:confirmation'],
            'confirmation'  => ['required', 'min:6', 'same:password'],
            'status'        => ['required'],
            'level'         => ['required'],
        ]);

        // upload file to storage
        if ($file) :
            $file = $file->store($folder);
        else :
            $file           = $default;
        endif;

        // insert data input to table Users
        $data = [
            'level_id'      => $level,
            'status_id'     => $status,
            'uuid'          => $uuid,
            'password'      => $password,
            'username'      => $username,
            'email'         => $email,
            'name'          => $name,
            'file'          => $file,
        ];
        User::create($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" ditambahkan',
            'alert'         => 'primary',
        ];
        return redirect('/admin/user')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'user'          => $user,
        ];
        return view('private.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'statuses'      => UserStatus::orderBy('id')->get(),
            'levels'        => UserLevel::orderByDesc('id')->get(),
            'user'          => $user,
        ];
        return view('private.user.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // data detail
        $uuid               = $user->uuid;
        $oldUsername        = $user->username;
        $oldEmail           = $user->email;
        $oldFile            = $user->file;

        // data input
        $name               = $request->name;
        $username           = $request->username;
        $email              = $request->email;
        $status             = $request->status;
        $level              = $request->level;
        $file               = $request->file('file');
        $message            = $name;
        $password           = Hash::make($request->password);
        $folder             = 'user';
        $default            = 'default-user.svg';

        // validation logic
        $oldUsername        !== $username ? $uUsername = "unique:users" : $uUsername = "";
        $oldEmail           !== $email ? $uEmail = "unique:users" : $uEmail = "";

        // validation input
        $validatedData      = $request->validate([
            'name'          => ['required', 'max:255'],
            'username'      => ['required', 'max:255', $uUsername],
            'email'         => ['required', 'max:255', $uEmail],
            'password'      => ['required', 'min:6', 'same:confirmation'],
            'confirmation'  => ['required', 'min:6', 'same:password'],
            'status'        => ['required'],
            'level'         => ['required'],
        ]);

        // upload file to storage
        if ($file) :
            // delete old file on storage before upload file
            if ($oldFile !== $default) :
                Storage::delete($oldFile);
            endif;
            $file = $file->store($folder);
        else :
            $file           = $oldFile;
        endif;

        // insert data input to table Admins
        $data = [
            'level_id'      => $level,
            'status_id'     => $status,
            'password'      => $password,
            'username'      => $username,
            'email'         => $email,
            'name'          => $name,
            'file'          => $file,
        ];
        User::where('uuid', $uuid)->update($data);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" diubah',
            'alert'         => 'success',
        ];
        return redirect('/admin/user')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // data detail
        $id                 = $user->id;
        $file               = $user->file;
        $message            = $user->name;
        $folder             = 'user';
        $default            = 'default-user.svg';

        // delete file on storage
        if ($file !== $default) :
            Storage::delete($file);
        endif;

        // delete data on table Admin
        User::destroy($id);

        // flashdata
        $flashData = [
            'message'       => 'Data "' . $message . '" dihapus!',
            'alert'         => 'danger',
        ];
        return redirect('/admin/user')->with($flashData);
    }
}
