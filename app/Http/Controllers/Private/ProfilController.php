<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public function index($id)
    {
        $data['profil']             = User::where('uuid', $id)->where('id', auth()->user()->id)->first();
        return view('private.profil.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['profil']             = User::where('uuid', $id)->where('id', auth()->user()->id)->first();
        return view('private.profil.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // data detail...

        $data['profil']             = User::where('uuid', $id)->where('id', auth()->user()->id)->first();
        $oldUsername                = $data['profil']->username;
        $oldEmail                   = $data['profil']->email;
        $oldPath                    = $data['profil']->path;
        $oldFile                    = $data['profil']->file;
        $level                      = Str::lower($data['profil']->level->name);


        // data input...
        $name                       = $request->name;
        $slug                       = Str::slug($name, '-');
        $username                   = $request->username;
        $email                      = $request->email;
        $file                       = $request->file('file');
        $path                       = 'user/' . date('Y/m/');
        $default                    = 'default-user.svg';

        // validation logic...
        $oldUsername                !== $username ? $uUsername = "unique:users" : $uUsername = "";
        $oldEmail                   !== $email ? $uEmail = "unique:users" : $uEmail = "";

        // validation input...
        $validatedData              = $request->validate([
            'name'                  => ['required', 'max:255'],
            'username'              => ['required', 'max:255', $uUsername],
            'email'                 => ['required', 'max:255', $uEmail],
        ]);

        // upload file to storage...
        if ($file) :
            // delete old file on storage before upload new file...
            if ($oldFile !== $default) :
                Storage::delete($path . $oldFile);
            endif;

            // manually specify a filename...
            $dateTime               = date('dmYhis');
            $nameHash               = $file->hashName();
            $fileName               = $dateTime . '-' . $nameHash;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $fileName               = $oldFile;
        endif;

        // insert to table...
        $data = [
            'username'              => $username,
            'email'                 => $email,
            'name'                  => $name,
            'slug'                  => $slug,
            'path'                  => $oldPath ? $oldPath : $path,
            'file'                  => $fileName,
        ];
        User::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Profil berhasil diubah!',
            'alert'                 => 'success',
            'icon'                  => 'edit',
        ];
        return redirect(route($request->segment(1) . '.profil.index', $id))->with($flashData);
    }

    public function passwordEdit($id)
    {
        $data['profil']             = User::where('uuid', $id)->where('id', auth()->user()->id)->first();
        return view('private.profil.password', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request, $id)
    {
        // data input...
        $password                   = Hash::make($request->password);

        // validation input...
        $validatedData              = $request->validate([
            'password'              => ['required', 'min:6', 'same:confirmation'],
            'confirmation'          => ['required', 'min:6', 'same:password'],
        ]);

        // insert data to table...
        $data = [
            'password'              => $password,
        ];
        User::where('uuid', $id)->where('id', auth()->user()->id)->update($data);

        // flashdata...
        $flashData = [
            'message'               => 'Password berhasil diubah!',
            'alert'                 => 'success',
            'icon'                  => 'key',
        ];
        return redirect(route($request->segment(1) . '.profil.index', $id))->with($flashData);
    }
}
