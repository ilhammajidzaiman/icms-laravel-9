<?php

namespace App\Http\Controllers\Private\Developer\Blog\Category;

use Illuminate\Http\Request;
use App\Models\Blog\BlogCategory;
use App\Http\Controllers\Controller;

class BlogCategoryTrashController extends Controller
{
    public function index()
    {
        $search                     = request(['search']);
        $data['categories']           = BlogCategory::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.level.developer.blog.category.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['category']           = BlogCategory::where('uuid', $id)->onlyTrashed()->first();
        $oldName                    = $data['category']->name;
        $message                    = $oldName;

        // restore data...
        BlogCategory::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dipulihkan!',
            'alert'                 => 'info',
            'icon'                  => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.blog.category.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['category']           = BlogCategory::where('uuid', $id)->onlyTrashed()->first();
        $oldId                      = $data['category']->id;
        $message                    = $data['category']->name;

        // delete data on table..
        BlogCategory::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus permanen!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.blog.category.trash.index')->with($flashData);
    }
}
