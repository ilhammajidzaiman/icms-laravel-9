<?php

namespace App\Http\Controllers\Private\Developer;

use App\Models\BlogPost;
use Illuminate\Http\File;
use App\Models\BlogStatus;
use App\Models\BlogArticle;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'articles'          => BlogArticle::orderByDesc('id')->get(),
        ];
        return view('private.blog-article.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'statuses'          => BlogStatus::orderBy('id')->get(),
            'categories'        => BlogCategory::orderBy('name')->get(),
        ];
        return view('private.blog-article.create', $data);
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
        $userId                 = auth()->user()->id;
        $title                  = $request->title;
        $content                = $request->content;
        $file                   = $request->file('file');
        $category               = $request->category;
        $status                 = $request->status;
        $message                = $title;
        $uuid                   = Str::uuid();
        $slug                   = Str::slug($title, '-') . '.html';
        $truncated              = Str::limit(strip_tags($content), 200, '...');
        $path                   = 'article/' . date('Y/m/');
        $default                = 'default-img.svg';

        // validation...
        $validatedData = $request->validate([
            'title'             => ['required', 'max:250', 'unique:blog_articles'],
            'content'           => ['required'],
            'status'            => ['required'],
            'file'              => ['file', 'image', 'mimes:jpeg,jpg,png,svg', 'max:11024'],
        ]);

        // upload file to storage...
        if ($file) :
            $dateTime           = date('dmYhis');
            $nameHash           = $file->hashName();
            $fileName           = $dateTime . '-' . $nameHash;

            // automatically store file...
            // $file               = $file->store($path);

            // automatically generate a unique ID for filename...
            // Storage::putFile($path, new File($file));

            // manually specify a filename...
            Storage::putFileAs($path, new File($file), $fileName);
        else :
            $fileName           = $default;
        endif;

        // insert to table...
        $data = [
            'uuid'              => $uuid,
            'user_id'           => $userId,
            'blog_status_id'    => $userId,
            'title'             => $title,
            'slug'              => $slug,
            'content'           => $content,
            'truncated'         => $truncated,
            'path'              => $path,
            'file'              => $fileName,
        ];
        BlogArticle::create($data);

        // insert to table pivot...
        if ($category) :
            $detail             = BlogArticle::where('slug', $slug)->first();
            $oldId              = $detail->id;
            $data2              = [];
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
            'message'           => 'Data "' . $message . '" ditambahkan',
            'alert'             => 'primary',
        ];
        return redirect('/developer/blog/post')->with($flashData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function show(BlogArticle $post)
    {

        $data = [
            'article'           => $post,
            'blogPosts'         => BlogPost::where('blog_article_id', $post->id)->orderBy('id')->with(['category'])->get(),
        ];
        return view('private.blog-article.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogArticle $blogArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogArticle $blogArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogArticle $blogArticle)
    {
        //
    }
}
