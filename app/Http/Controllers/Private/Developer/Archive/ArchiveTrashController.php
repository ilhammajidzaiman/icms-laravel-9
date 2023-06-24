<?php

namespace App\Http\Controllers\Private\Developer\Archive;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArchiveTrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['archives']               = Archive::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.developer.archive.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['archive']                = Archive::where('slug', $id)->onlyTrashed()->first();
        $oldId                          = $data['archive']->id;
        $message                        = $data['archive']->title;

        // restore data...
        Archive::withTrashed()->where('id', $oldId)->restore();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dipulihkan!',
            'alert'                     => 'info',
            'icon'                      => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.archive.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['archive']                = Archive::where('slug', $id)->onlyTrashed()->first();
        $oldId                          = $data['archive']->id;
        $path                           = $data['archive']->path;
        $file                           = $data['archive']->file;
        $message                        = $data['archive']->title;
        $default                        = 'default-img.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table...
        Archive::withTrashed()->where('id', $oldId)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.archive.trash.index')->with($flashData);
    }
}
