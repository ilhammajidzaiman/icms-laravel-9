<?php

namespace App\Http\Controllers\Private\Developer\NavMenu\Child;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NavMenu\NavMenuChild;

class NavMenuChildTrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['navMenuChild']           = NavMenuChild::onlyTrashed()->orderByDesc('order')->get();
        return view('private.level.developer.galery.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['navMenuChild']           = NavMenuChild::onlyTrashed()->where('uuid', $id)->first();
        $message                        = $data['navMenuChild']->name;

        // restore data...
        NavMenuChild::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dipulihkan!',
            'alert'                     => 'info',
            'icon'                      => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.nav-menu.parent.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['navMenuChild']           = NavMenuChild::onlyTrashed()->where('uuid', $id)->first();
        $message                        = $data['navMenuChild']->name;

        // delete data on table...
        NavMenuChild::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.nav-menu.parent.trash.index')->with($flashData);
    }
}
