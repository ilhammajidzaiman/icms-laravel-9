<?php

namespace App\Http\Controllers\Private\Developer\Blog;

use Illuminate\Http\Request;
use App\Models\Blog\BlogCategory;
use App\Http\Controllers\Controller;

class BlogCategoryTrashController extends Controller
{
    public function index()
    {
        $data['categories']         = BlogCategory::onlyTrashed()->orderByDesc('id')->get();
        return view('private.developer.blog.category.trash', $data);
    }

    public function restore($id)
    {
        // data detail...
        $data['category']           = BlogCategory::where('slug', $id)->onlyTrashed()->first();
        $oldId                      = $data['category']->id;
        $oldName                    = $data['category']->name;
        $message                    = $oldName;

        // restore data...
        BlogCategory::withTrashed()->where('id', $oldId)->restore();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dipulihkan!',
            'alert'                 => 'info',
            'icon'                  => 'fa-fw fas fa-recycle',
        ];
        return redirect()->back()->with($flashData);
    }

    public function destroy($id)
    {
        // data detail...
        $data['category']           = BlogCategory::where('slug', $id)->onlyTrashed()->first();
        $oldId                      = $data['category']->id;
        $oldName                    = $data['category']->name;
        $message                    = $oldName;

        // delete data on table..
        BlogCategory::withTrashed()->where('id', $oldId)->forceDelete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus permanen!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->back()->with($flashData);
    }
}
