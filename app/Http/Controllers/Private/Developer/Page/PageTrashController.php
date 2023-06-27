<?php

namespace App\Http\Controllers\Private\Developer\Page;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PageTrashController extends Controller
{
    public function index()
    {
        $search                     = request(['search']);
        $data['pages']              = Page::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.level.developer.page.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['page']               = Page::where('uuid', $id)->onlyTrashed()->first();
        $message                    = $data['page']->title;

        // restore data...
        Page::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dipulihkan!',
            'alert'                 => 'info',
            'icon'                  => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.page.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['page']               = Page::where('uuid', $id)->onlyTrashed()->first();
        $message                    = $data['page']->title;

        // delete data on table...
        Page::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus permanen!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.page.trash.index')->with($flashData);
    }
}
