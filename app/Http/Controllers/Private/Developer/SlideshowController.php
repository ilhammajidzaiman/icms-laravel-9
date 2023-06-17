<?php

namespace App\Http\Controllers\Private\Developer;

use App\Models\Status;
use App\Models\Slideshow;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                         = request(['search']);
        $data['slideshows']             = Slideshow::filter($search)->orderByDesc('id')->paginate(4)->withQueryString();
        return view('private.developer.slideshow.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['statuses']               = Status::orderBy('id')->get();
        return view('private.developer.slideshow.create', $data);
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
        $file                           = $request->file('file');
        $title                          = $request->title;
        $detail                         = $request->detail;
        $status                         = $request->status;
        $message                        = $title;
        $uuid                           = Str::uuid();
        $slug                           = Str::slug($title, '-');
        $folder                         = 'slideshow/' . date('Y/m/');
        $default                        = 'default-slideshow.svg';

        // validation...
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:100', 'unique:slideshows'],
            'detail'                    => ['required', 'max:255',],
            'status'                    => ['required'],
            'file'                      => ['file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :
            // manually specify a filename...
            $dateTime                   = date('dmYhis');
            $nameHash                   = $file->hashName();
            $fileName                   = $dateTime . '-' . $nameHash;
            $path                       = $folder;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $path                       = null;
            $fileName                   = $default;
        endif;

        // insert to table...
        $data = [
            'uuid'                      => $uuid,
            'status_id'                 => $status,
            'title'                     => $title,
            'slug'                      => $slug,
            'detail'                    => $detail,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        Slideshow::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect(route($request->segment(1) . '.slideshow.index'))->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['slideshow']              = Slideshow::where('uuid', $id)->first();
        return view('private.developer.slideshow.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['statuses']               = Status::orderBy('id')->get();
        $data['slideshow']              = Slideshow::where('uuid', $id)->first();
        return view('private.developer.slideshow.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // detail data
        $data['slideshow']              = Slideshow::where('uuid', $id)->first();
        $oldTitle                       = $data['slideshow']->title;
        $oldPath                        = $data['slideshow']->path;
        $oldFile                        = $data['slideshow']->file;

        // data input...
        $file                           = $request->file('file');
        $title                          = $request->title;
        $detail                         = $request->detail;
        $status                         = $request->status;
        $message                        = $title;
        $slug                           = Str::slug($title, '-');
        $folder                         = 'slideshow/' . date('Y/m/');
        $default                        = 'default-slideshow.svg';

        // validation logic
        $oldTitle                       !== $title ? $uTitle = "unique:slideshows" : $uTitle = "";

        // validation
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:250', $uTitle],
            'detail'                    => ['required', 'max:255',],
            'status'                    => ['required'],
            'file'                      => ['file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :
            // delete old file on storage before upload new file...
            if ($oldFile !== $default) :
                Storage::delete($oldPath . $oldFile);
            endif;

            // manually specify a filename...
            $dateTime                   = date('dmYhis');
            $nameHash                   = $file->hashName();
            $fileName                   = $dateTime . '-' . $nameHash;
            $path                       = $folder;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $path                       = $oldPath;
            $fileName                   = $oldFile;
        endif;

        // insert to table...
        $data = [
            'status_id'                 => $status,
            'title'                     => $title,
            'slug'                      => $slug,
            'detail'                    => $detail,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        Slideshow::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect(route($request->segment(1) . '.slideshow.index'))->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['slideshow']              = Slideshow::where('uuid', $id)->first();
        $oldId                          = $data['slideshow']->id;
        $file                           = $data['slideshow']->file;
        $path                           = $data['slideshow']->path;
        $message                        = $data['slideshow']->title;
        $default                        = 'default-slideshow.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table...
        Slideshow::destroy($oldId);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect(route($request->segment(1) . '.slideshow.index'))->with($flashData);
    }
}
