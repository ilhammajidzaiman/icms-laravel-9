<?php

namespace App\Http\Controllers\Private\Developer\Slideshow;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SlideshowTrashController extends Controller
{
    public function index()
    {
        $search                     = request(['search']);
        $data['slideshows']         = Slideshow::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.developer.slideshow.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['slideshow']          = Slideshow::where('uuid', $id)->onlyTrashed()->first();
        $oldId                      = $data['slideshow']->id;
        $message                    = $data['slideshow']->title;

        // restore data...
        Slideshow::withTrashed()->where('id', $oldId)->restore();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dipulihkan!',
            'alert'                 => 'info',
            'icon'                  => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.slideshow.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['slideshow']          = Slideshow::where('uuid', $id)->onlyTrashed()->first();
        $file                       = $data['slideshow']->file;
        $path                       = $data['slideshow']->path;
        $message                    = $data['slideshow']->title;
        $default                    = 'default-slideshow.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table..
        Slideshow::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus permanen!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.slideshow.trash.index')->with($flashData);
    }
}
