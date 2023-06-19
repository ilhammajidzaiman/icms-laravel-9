<?php

namespace App\Http\Controllers\Private\Developer\Galery;

use App\Models\Galery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['galeries']               = Galery::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.developer.galery.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['galery']                 = Galery::where('slug', $id)->onlyTrashed()->first();
        $oldId                          = $data['galery']->id;
        $message                        = $data['galery']->title;

        // restore data...
        Galery::withTrashed()->where('id', $oldId)->restore();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dipulihkan!',
            'alert'                     => 'info',
            'icon'                      => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.galery.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['galery']                 = Galery::where('slug', $id)->onlyTrashed()->first();
        $oldId                          = $data['galery']->id;
        $file                           = $data['galery']->file;
        $path                           = $data['galery']->path;
        $message                        = $data['galery']->title;
        $default                        = 'default-img.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table...
        Galery::withTrashed()->where('id', $oldId)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.galery.trash.index')->with($flashData);
    }
}
