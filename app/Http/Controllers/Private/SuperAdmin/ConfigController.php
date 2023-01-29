<?php

namespace App\Http\Controllers\Private\SuperAdmin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'config'          => Config::where('id', 1)->first(),
        ];
        return view('private.config.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = [
            'config'          => Config::where('id', 1)->first(),
        ];
        return view('private.config.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        // data detail
        $old                = Config::where('id', 1)->first();
        $oldFile            = $old->file;
        // dd($oldFile);

        // data input
        $app                = $request->app;
        $detail             = $request->detail;
        $copyright          = $request->copyright;
        $file               = $request->file('file');
        $folder             = 'logo';
        $default            = 'logo.svg';

        // // validation logic
        // $oldName            !== $name ? $uName = "unique:user_statuses" : $uName = "";

        // validation
        $validatedData      = $request->validate([
            'app'           => ['required', 'max:255'],
            'detail'        => ['required', 'max:255'],
            'copyright'     => ['required', 'max:255'],
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

        // insert to table
        $data = [
            'app'           => $app,
            'detail'        => $detail,
            'copyright'     => $copyright,
            'file'          => $file,
        ];
        Config::where('id', 1)->update($data);

        // flashdata
        $flashData = [
            'message'       => 'config Aplikasi diubah!',
            'alert'         => 'success',
        ];
        return redirect('/admin/config')->with($flashData);
    }
}
