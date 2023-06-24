<?php

namespace App\Http\Controllers\Private\Developer\Blog\Post;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogStatus;
use App\Models\Blog\BlogArticle;
use App\Models\Blog\BlogCategory;
use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search                         = request(['search']);
        $data['articles']               = BlogArticle::filter($search)->orderByDesc('id')->paginate(20)->withQueryString();
        $data['count']                  = BlogArticle::onlyTrashed()->orderByDesc('id')->get()->count();
        return view('private.developer.blog.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['statuses']               = BlogStatus::orderBy('id')->get();
        $data['categories']             = BlogCategory::orderBy('name')->get();
        return view('private.developer.blog.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data input...
        $userId                         = auth()->user()->id;
        $title                          = $request->title;
        $content                        = $request->content;
        $file                           = $request->file('file');
        $category                       = $request->category;
        $status                         = $request->status;
        $message                        = $title;
        $uuid                           = Str::uuid();
        $slug                           = Str::slug($title, '-');
        $truncated                      = Str::limit(strip_tags($content), 200, '...');
        $folder                         = 'article/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // validation...
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:255', 'unique:blog_articles'],
            'content'                   => ['required'],
            'status'                    => ['required'],
            'file'                      => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :

            // automatically store file...
            // $file               = $file->store($path);

            // automatically generate a unique ID for filename...
            // Storage::putFile($path, new File($file));

            // manually specify a filename...
            $dateTime                   = date('YmdHis');
            $nameHash                   = $file->hashName();
            $nameExtension              = $file->extension();
            $fileName                   = $dateTime . '-' . $slug . '.' . $nameExtension;
            $path                       = $folder;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $path                       = null;
            $fileName                   = $default;
        endif;

        // insert to table...
        $data = [
            'uuid'                      => $uuid,
            'user_id'                   => $userId,
            'blog_status_id'            => $status,
            'title'                     => $title,
            'slug'                      => $slug,
            'content'                   => $content,
            'truncated'                 => $truncated,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        BlogArticle::create($data);

        // insert to table pivot...
        if ($category) :
            $detail                     = BlogArticle::where('uuid', $uuid)->first();
            $oldId                      = $detail->id;
            $data2                      = [];
            foreach ($category as $key) :
                $data2[] = BlogPost::create([
                    'blog_article_id'   => $oldId,
                    'blog_category_id'  => $key,
                ]);
            endforeach;
        endif;

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect()->route($request->segment(1) . '.blog.post.index')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['article']                = BlogArticle::where('uuid', $id)->first();
        $data['blogPosts']              = BlogPost::where('blog_article_id', $data['article']->id)->orderBy('id')->with(['category'])->get();
        return view('private.developer.blog.post.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['statuses']               = BlogStatus::orderBy('id')->get();
        $data['categories']             = BlogCategory::orderBy('name')->get();
        $data['article']                = BlogArticle::where('uuid', $id)->first();
        $data['blogPosts']              = BlogPost::where('blog_article_id', $data['article']->id)->orderBy('id')->with(['category'])->get();
        return view('private.developer.blog.post.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // detail data
        $data['article']                = BlogArticle::where('uuid', $id)->first();
        $oldId                          = $data['article']->id;
        $oldTitle                       = $data['article']->title;
        $oldPath                        = $data['article']->path;
        $oldFile                        = $data['article']->file;

        // data input...
        $userId                         = auth()->user()->id;
        $title                          = $request->title;
        $content                        = $request->content;
        $file                           = $request->file('file');
        $category                       = $request->category;
        $status                         = $request->status;
        $message                        = $title;
        $slug                           = Str::slug($title, '-');
        $truncated                      = Str::limit(strip_tags($content), 200, '...');
        $folder                         = 'article/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // validation logic
        $oldTitle                       !== $title ? $uTitle = "unique:blog_articles" : $uTitle = "";

        // validation
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:250', $uTitle],
            'content'                   => ['required'],
            'status'                    => ['required'],
            'file'                      => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :
            // delete old file on storage before upload new file...
            if ($oldFile !== $default) :
                Storage::delete($oldPath . $oldFile);
            endif;

            // manually specify a filename...
            $dateTime                   = date('YmdHis');
            $nameHash                   = $file->hashName();
            $nameExtension              = $file->extension();
            $fileName                   = $dateTime . '-' . $slug . '.' . $nameExtension;
            $path                       = $folder;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $path                       = $oldPath;
            $fileName                   = $oldFile;
        endif;

        // insert to table...
        $data = [
            'user_id'                   => $userId,
            'blog_status_id'            => $status,
            'title'                     => $title,
            'slug'                      => $slug,
            'content'                   => $content,
            'truncated'                 => $truncated,
            'path'                      => $path,
            'file'                      => $fileName,
        ];
        BlogArticle::where('uuid', $id)->update($data);

        // delete to posts
        BlogPost::where('blog_article_id', $oldId)->delete();

        // insert to table pivot...
        if ($category) :
            $data2                      = [];
            foreach ($category as $key) :
                $data2[] = BlogPost::create([
                    'blog_article_id'   => $oldId,
                    'blog_category_id'  => $key,
                ]);
            endforeach;
        endif;

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect()->route($request->segment(1) . '.blog.post.index')->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // data detail...
        $data['article']                = BlogArticle::where('uuid', $id)->first();
        $oldId                          = $data['article']->id;
        $message                        = $data['article']->title;

        // delete data on table...
        BlogArticle::destroy($oldId);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect()->route($request->segment(1) . '.blog.post.index')->with($flashData);
    }
}
