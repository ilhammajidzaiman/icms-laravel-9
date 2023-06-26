<?php

namespace App\Http\Controllers\Private\Developer\Management\Level;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserLevel;
use Illuminate\Support\Facades\Storage;

class UserLevelTrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['levels']                 = UserLevel::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.developer.management.level.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['level']                  = UserLevel::where('uuid', $id)->onlyTrashed()->first();
        $message                        = $data['level']->name;

        // restore data...
        UserLevel::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dipulihkan!',
            'alert'                     => 'info',
            'icon'                      => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.management.user.level.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['level']                  = UserLevel::where('uuid', $id)->onlyTrashed()->first();
        $message                        = $data['level']->name;

        // delete data on table...
        UserLevel::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.management.user.level.trash.index')->with($flashData);
    }
}
