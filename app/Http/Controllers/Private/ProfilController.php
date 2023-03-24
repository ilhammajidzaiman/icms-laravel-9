<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $id = auth()->user()->id;
        $data = [
            'profil' => User::where('uuid', $uuid)->where('id', $id)->first(),
        ];
        return view('private.user-profil.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $id = auth()->user()->id;
        $data = [
            'profil' => User::where('uuid', $uuid)->where('id', $id)->first(),
        ];
        return view('private.user-profil.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // data detail
        $id                     = auth()->user()->id;
        $profil                 = User::where('uuid', $uuid)->where('id', $id)->first();
        $oldUsername            = $profil->username;
        $oldEmail               = $profil->email;
        $oldPath                = $profil->path;
        $oldFile                = $profil->file;
        $level                  = Str::lower($profil->level->name);

        // data input
        $name                   = $request->name;
        $username               = $request->username;
        $email                  = $request->email;
        $file                   = $request->file('file');
        $path                   = 'user/' . date('Y/m/');
        $default                = 'default-user.svg';

        // validation logic
        $oldUsername            !== $username ? $uUsername = "unique:users" : $uUsername = "";
        $oldEmail               !== $email ? $uEmail = "unique:users" : $uEmail = "";

        // validation input
        $validatedData          = $request->validate([
            'name'              => ['required', 'max:255'],
            'username'          => ['required', 'max:255', $uUsername],
            'email'             => ['required', 'max:255', $uEmail],
        ]);

        // upload file to storage...
        if ($file) :
            // delete old file on storage before upload new file...
            if ($oldFile !== $default) :
                Storage::delete($path . $oldFile);
            endif;

            // manually specify a filename...
            $dateTime           = date('dmYhis');
            $nameHash           = $file->hashName();
            $fileName           = $dateTime . '-' . $nameHash;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $fileName           = $default;
        endif;

        // insert data input to table Admins
        $data = [
            'username'          => $username,
            'email'             => $email,
            'name'              => $name,
            'path'              => $oldPath ? $oldPath : $path,
            'file'              => $fileName,
        ];
        User::where('uuid', $uuid)->update($data);

        // flashdata
        $flashData = [
            'message'           => 'Profil berhasil diubah!',
            'alert'             => 'success',
        ];
        return redirect('/' . $level . '/profil/' . $uuid)->with($flashData);
    }

    public function password($uuid)
    {
        $id = auth()->user()->id;
        $data = [
            'profil' => User::where('uuid', $uuid)->where('id', $id)->first(),
        ];
        return view('private.user-profil.password', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, $uuid)
    {
        // data detail
        $id                 = auth()->user()->id;
        $profil             = User::where('uuid', $uuid)->where('id', $id)->first();

        $oldUsername        = $profil->username;
        $level              = strtolower($profil->level->name);

        // data input
        $username           = $request->username;
        $password           = Hash::make($request->password);



        $credentials = $request->validate([
            'old'         => ['required', 'old'],
        ]);
        if (Auth::attempt($credentials)) :
            return "okeeee";
        else :
            return "gagal";
        endif;


        // // validation logic
        // $oldUsername        !== $username ? $uUsername = "unique:users" : $uUsername = "";

        // // validation input
        // $validatedData      = $request->validate([
        //     'username'      => ['required', 'max:255', $uUsername],

        //     'password'      => ['required', 'min:6', 'same:confirmation'],
        //     'confirmation'  => ['required', 'min:6', 'same:password'],
        // ]);

        // // insert data input to table Admins
        // $data = [
        //     'password'      => $password,
        // ];
        // User::where('uuid', $uuid)->update($data);

        // // flashdata
        // $flashData = [
        //     'message'       => 'Password diubah!',
        //     'alert'         => 'success',
        // ];
        // return redirect('/' . $level . '/profil/' . $uuid)->with($flashData);
    }
}
