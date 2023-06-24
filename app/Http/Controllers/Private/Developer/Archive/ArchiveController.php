<?php

namespace App\Http\Controllers\Private\Developer\Archive;

use App\Models\Status;
use App\Models\Archive;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                         = request(['search']);
        $data['archives']               = Archive::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        $data['count']                  = Archive::onlyTrashed()->orderByDesc('id')->get()->count();
        return view('private.developer.archive.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['statuses']               = Status::orderBy('id')->get();
        return view('private.developer.archive.create', $data);
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
        $status                         = $request->status;
        $message                        = $title;
        $uuid                           = Str::uuid();
        $slug                           = Str::slug($title, '-');
        $folder                         = 'archive/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // validation...
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:100', 'unique:archives'],
            'status'                    => ['required'],
            'file'                      => ['required', 'file', 'mimes:jpg,jpeg,png,svg,pdf,doc,ppt,xls,docx,pptx,xlsx', 'max:11024'],
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

        // insert to table...
        $data = [
            'uuid'                      => $uuid,
            'status_id'                 => $status,
            'title'                     => $title,
            'slug'                      => $slug,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        Archive::create($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.archive.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['archive']                = Archive::where('uuid', $id)->first();
        return view('private.developer.archive.show', $data);
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
        $data['page']                   = Archive::where('uuid', $id)->first();
        return view('private.developer.archive.update', $data);
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
        $data['archive']                = Archive::where('uuid', $id)->first();
        $oldTitle                       = $data['archive']->title;
        $oldPath                        = $data['archive']->path;
        $oldFile                        = $data['archive']->file;

        // data input...
        $file                           = $request->file('file');
        $title                          = $request->title;
        $status                         = $request->status;
        $message                        = $title;
        $slug                           = Str::slug($title, '-');
        $folder                         = 'archive/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // validation logic
        $oldTitle                       !== $title ? $uTitle = "unique:archives" : $uTitle = "";

        // validation
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:250', $uTitle],
            'status'                    => ['required'],
            'file'                      => ['required', 'file', 'mimes:jpg,jpeg,png,svg,pdf,doc,ppt,xls,docx,pptx,xlsx', 'max:11024'],
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

        // insert to table...
        $data = [
            'status_id'                 => $status,
            'title'                     => $title,
            'slug'                      => $slug,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        Archive::where('uuid', $id)->update($data);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.archive.index')->with($flashData);
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
        $data['archive']                = Archive::where('uuid', $id)->first();
        $oldId                          = $data['archive']->id;
        $message                        = $data['archive']->title;

        // delete data on table...
        Archive::destroy($oldId);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.archive.index')->with($flashData);
    }
}
