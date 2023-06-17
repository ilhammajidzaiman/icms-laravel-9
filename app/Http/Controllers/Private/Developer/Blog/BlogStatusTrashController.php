<?php

namespace App\Http\Controllers\Private\Developer\Blog;

use Illuminate\Http\Request;
use App\Models\Blog\BlogStatus;
use App\Http\Controllers\Controller;

class BlogStatusTrashController extends Controller
{
    public function index()
    {
        $search                     = request(['search']);
        $data['statuses']           = BlogStatus::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.developer.blog.status.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['status']             = BlogStatus::where('slug', $id)->onlyTrashed()->first();
        $oldId                      = $data['status']->id;
        $oldName                    = $data['status']->name;
        $message                    = $oldName;

        // restore data...
        BlogStatus::withTrashed()->where('id', $oldId)->restore();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dipulihkan!',
            'alert'                 => 'info',
            'icon'                  => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.blog.status.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['status']             = BlogStatus::where('slug', $id)->onlyTrashed()->first();
        $oldId                      = $data['status']->id;
        $message                    = $data['status']->name;

        // delete data on table..
        BlogStatus::withTrashed()->where('id', $oldId)->forceDelete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus permanen!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.blog.status.trash.index')->with($flashData);
    }
}
