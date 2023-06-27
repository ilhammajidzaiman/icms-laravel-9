<?php

namespace App\Http\Controllers\Private\Developer\Blog\Post;

use Illuminate\Http\Request;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogArticle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogPostTrashController extends Controller
{
    public function index()
    {
        $search                     = request(['search']);
        $data['articles']           = BlogArticle::onlyTrashed()->filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        return view('private.level.developer.blog.post.trash', $data);
    }

    public function restore(Request $request, $id)
    {
        // data detail...
        $data['article']            = BlogArticle::where('uuid', $id)->onlyTrashed()->first();
        $oldId                      = $data['article']->id;
        $message                    = $data['article']->title;

        // restore data...
        BlogArticle::withTrashed()->where('uuid', $id)->restore();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dipulihkan!',
            'alert'                 => 'info',
            'icon'                  => 'fa-fw fas fa-recycle',
        ];
        return redirect()->route($request->segment(1) . '.blog.post.trash.index')->with($flashData);
    }

    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['article']                = BlogArticle::where('uuid', $id)->onlyTrashed()->first();
        $oldId                          = $data['article']->id;
        $path                           = $data['article']->path;
        $file                           = $data['article']->file;
        $message                        = $data['article']->title;
        $default                        = 'default-img.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($path . $file);
        endif;

        // delete data on table...
        BlogPost::where('blog_article_id', $oldId)->delete();
        BlogArticle::withTrashed()->where('uuid', $id)->forceDelete();

        // flashdata...
        $flashData = [
            'message'               => 'Data "' . $message . '" dihapus permanen!',
            'alert'                 => 'danger',
            'icon'                  => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.blog.post.trash.index')->with($flashData);
    }
}
