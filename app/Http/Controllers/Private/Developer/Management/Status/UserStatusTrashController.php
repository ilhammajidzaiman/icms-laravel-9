<?php

namespace App\Http\Controllers\Private\Developer\Management\Status;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\UserStatus;
use Illuminate\Support\Facades\Storage;

class UserStatusTrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['statuses']               = UserStatus::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.level.developer.management.status.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['status']                 = UserStatus::where('uuid', $id)->onlyTrashed()->first();
        $message                        = $data['status']->name;

        // restore data...
        UserStatus::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dipulihkan!',
            'alert'                     => 'info',
            'icon'                      => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.management.user.status.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['status']                 = UserStatus::where('uuid', $id)->onlyTrashed()->first();
        $message                        = $data['status']->name;

        // delete data on table...
        UserStatus::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.management.user.status.trash.index')->with($flashData);
    }
}
