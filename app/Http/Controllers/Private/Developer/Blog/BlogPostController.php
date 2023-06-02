<?php

namespace App\Http\Controllers\Private\Developer\Blog;

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
        return view('private.developer.blog.article.index', $data);
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
        return view('private.developer.blog.article.create', $data);
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
        $slug                           = Str::slug($title, '-') . '.html';
        $truncated                      = Str::limit(strip_tags($content), 200, '...');
        $path                           = 'article/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // validation...
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:250', 'unique:blog_articles'],
            'content'                   => ['required'],
            'status'                    => ['required'],
            'file'                      => ['file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :

            // automatically store file...
            // $file               = $file->store($path);

            // automatically generate a unique ID for filename...
            // Storage::putFile($path, new File($file));

            // manually specify a filename...
            $dateTime                   = date('dmYhis');
            $nameHash                   = $file->hashName();
            $fileName                   = $dateTime . '-' . $nameHash;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
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
            $detail                     = BlogArticle::where('slug', $slug)->first();
            $oldId                      = $detail->id;
            $data2                      = [];
            foreach ($category as $key) :
                $data2[] =
                    [
                        'blog_article_id'   => $oldId,
                        'blog_category_id'  => $key,
                    ];
            endforeach;
            BlogPost::insert($data2);
        endif;

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" ditambahkan',
            'alert'                     => 'primary',
            'icon'                      => 'fa-fw fas fa-check',
        ];
        return redirect(route('developer.blog.post.index'))->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['article']                = BlogArticle::where('slug', $id)->first();
        $data['blogPosts']              = BlogPost::where('blog_article_id', $data['article']->id)->orderBy('id')->with(['category'])->get();
        return view('private.developer.blog.article.show', $data);
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
        $data['article']                = BlogArticle::where('slug', $id)->first();
        $data['blogPosts']              = BlogPost::where('blog_article_id', $data['article']->id)->orderBy('id')->with(['category'])->get();
        return view('private.developer.blog.article.update', $data);
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
        $data['article']                = BlogArticle::where('slug', $id)->first();
        $oldId                          = $data['article']->id;
        $oldslug                        = $data['article']->slug;
        $oldUuid                        = $data['article']->uuid;
        $oldTitle                       = $data['article']->title;
        $oldFile                        = $data['article']->file;

        // data input...
        $userId                         = auth()->user()->id;
        $title                          = $request->title;
        $content                        = $request->content;
        $file                           = $request->file('file');
        $category                       = $request->category;
        $status                         = $request->status;
        $message                        = $title;
        $slug                           = Str::slug($title, '-') . '.html';
        $truncated                      = Str::limit(strip_tags($content), 200, '...');
        $path                           = 'article/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // validation logic
        $oldTitle                       !== $title ? $uTitle = "unique:blog_articles" : $uTitle = "";

        // validation
        $validatedData = $request->validate([
            'title'                     => ['required', 'max:250', $uTitle],
            'content'                   => ['required'],
            'status'                    => ['required'],
            'file'                      => ['file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :
            // delete old file on storage before upload new file...
            if ($oldFile !== $default) :
                Storage::delete($path . $oldFile);
            endif;

            // manually specify a filename...
            $dateTime                   = date('dmYhis');
            $nameHash                   = $file->hashName();
            $fileName                   = $dateTime . '-' . $nameHash;
            Storage::putFileAs($path, new File($file), $fileName);
        else :
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
        BlogArticle::where('slug', $id)->update($data);

        // delete to posts
        BlogPost::where('blog_article_id', $oldId)->delete();

        // insert to table pivot...
        if ($category) :
            $data2                      = [];
            foreach ($category as $key) :
                $data2[] =
                    [
                        'blog_article_id'   => $oldId,
                        'blog_category_id'  => $key,
                    ];
            endforeach;
            BlogPost::insert($data2);
        endif;

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" diubah',
            'alert'                     => 'success',
            'icon'                      => 'fa-fw fas fa-edit',
        ];
        return redirect(route('developer.blog.post.index'))->with($flashData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // data detail...
        $data['article']                = BlogArticle::where('slug', $id)->first();
        $id                             = $data['article']->id;
        $file                           = $data['article']->file;
        $message                        = $data['article']->title;
        $folder                         = 'article/' . date('Y/m/');
        $default                        = 'default-img.svg';

        // delete file on storage...
        if ($file !== $default) :
            Storage::delete($folder . $file);
        endif;

        // delete data on table...
        BlogPost::where('blog_article_id', $id)->delete();
        BlogArticle::destroy($id);

        // flashdata...
        $flashData = [
            'message'                   => 'Data "' . $message . '" dihapus!',
            'alert'                     => 'danger',
            'icon'                      => 'fa-fw fas fa-trash',
        ];
        return redirect(route('developer.blog.post.index'))->with($flashData);
    }
}
