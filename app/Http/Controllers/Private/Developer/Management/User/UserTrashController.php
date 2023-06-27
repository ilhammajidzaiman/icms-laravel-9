<?php

namespace App\Http\Controllers\Private\Developer\Management\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserTrashController extends Controller
{
    public function index()
    {
        $search                         = request(['search']);
        $data['users']                  = User::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.level.developer.management.user.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['user']                   = User::where('uuid', $id)->onlyTrashed()->first();
        $message                        = $data['user']->name;

        // restore data...
        User::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dipulihkan!',
            'alert'                     => 'info',
            'icon'                      => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.management.user.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['user']                   = User::where('uuid', $id)->onlyTrashed()->first();
        $file                           = $data['user']->file;
        $path                           = $data['user']->path;
        $message                        = $data['user']->name;
        $default                        = 'default-user.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table...
        User::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus permanen!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.management.user.trash.index')->with($flashData);
    }
}
