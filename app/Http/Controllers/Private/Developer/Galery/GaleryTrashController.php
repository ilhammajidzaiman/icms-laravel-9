<?php

namespace App\Http\Controllers\Private\Developer\Galery;

use App\Models\Galery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleryTrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['galeries']               = Galery::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.level.developer.galery.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['galery']                 = Galery::where('uuid', $id)->onlyTrashed()->first();
        $message                        = $data['galery']->title;

        // restore data...
        Galery::withTrashed()->where('uuid', $id)->restore();

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
        $data['galery']                 = Galery::where('uuid', $id)->onlyTrashed()->first();
        $file                           = $data['galery']->file;
        $path                           = $data['galery']->path;
        $message                        = $data['galery']->title;
        $default                        = 'default-img.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table...
        Galery::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.galery.trash.index')->with($flashData);
    }
}
