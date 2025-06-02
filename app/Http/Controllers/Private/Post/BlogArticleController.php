<?php

namespace App\Http\Controllers\Private\Post;

use Illuminate\Support\Str;
use App\Models\Post\BlogTag;
use Illuminate\Http\Request;
use App\Models\Post\BlogPost;
use App\Models\Post\BlogArticle;
use App\Models\Post\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Private\Post\BlogArticleRequest;

class BlogArticleController extends Controller
{
    private $model = BlogArticle::class;
    private $title = 'artikel';
    private $route = 'blog.article';
    private $view = 'private.blog.article';
    private $scope = ['search', 'start_date', 'end_date'];
    private $pagination = 10;

    public function index(Request $request)
    {
        $data['record'] = $this->model::filter($request->only($this->scope))
            ->with(['user', 'tags', 'category'])
            ->orderByDesc('id')
            ->paginate($this->pagination)
            ->withQueryString();
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'index',
            'method' => null,
            'label' => 'daftar',
            'heading' => null,
        ];
        confirmDelete(Str::ucfirst(__('hapus')), Str::ucfirst(__('anda yakin ingin menghapus data?')));
        return view($this->view . '.list', $data);
    }

    public function create()
    {
        $data['category'] = BlogCategory::show()
            ->orderby('title')
            ->get();
        $data['tag'] = BlogTag::show()
            ->orderby('title')
            ->get();
        $data['record'] = new $this->model;
        $data['selectedTags'] = $data['record']->posts
            ->pluck('blog_tag_id')
            ->toArray();
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'store',
            'method' => 'post',
            'label' => 'buat',
            'heading' => null,
        ];
        return view($this->view . '.form', $data);
    }

    public function store(BlogArticleRequest $request)
    {
        if ($request->has('file')) :
            $path = 'article/' . now()->format('Y/m/');
            $temporary = $request->file;
            $filePath = $path . basename($temporary);
            Storage::disk('public')
                ->put($filePath, Storage::get($temporary));
            Storage::delete($temporary);
            $file = $filePath ?? null;
        endif;
        if ($request->has('attachment')) :
            $attachment = [];
            $path = 'attachment/' . now()->format('Y/m/');
            $temporary = $request->attachment;
            foreach ($temporary as $item) :
                $attachmentPath = $path . basename($item);
                Storage::disk('public')->put($attachmentPath, Storage::get($item));
                Storage::delete($item);
                $attachment[] = $attachmentPath;
            endforeach;
            $attachment = $attachment;
        endif;
        $blogArticle = $this->model::create([
            'user_id' => Auth::user()->id ?? null,
            'blog_category_id' => $request->category ?? null,
            'slug' => Str::slug($request->title ?? null, '-') ?? null,
            'title' => $request->title ?? null,
            'content' => $request->content ?? null,
            'description' => $request->description ?? null,
            'file' => $file ?? null,
            'attachment' => $attachment ?? null,
            'visitor' => 0,
            'is_show' =>  $request->is_show ? true : false,
            'published_at' => now(),
        ]);
        if ($request->tag) :
            foreach ($request->tag as $item) :
                BlogPost::create([
                    'blog_article_id' => $blogArticle->id ?? null,
                    'blog_tag_id' => $item ?? null,
                ]);
            endforeach;
        endif;
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data disimpan.')));
        return redirect()->route($this->route . '.index');
    }

    public function show(string $id)
    {
        $data['record'] = $this->model::withTrashed()
            ->with(['user', 'tags', 'category'])
            ->where('uuid', $id)
            ->first();
        if (!$data['record']) :
            abort(404);
        endif;
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'show',
            'method' => null,
            'label' => 'lihat',
            'heading' => $data['record']->title,
        ];
        return view($this->view . '.show', $data);
    }

    public function edit(string $id)
    {
        $data['category'] = BlogCategory::show()
            ->orderby('title')
            ->get();
        $data['tag'] = BlogTag::show()
            ->orderby('title')
            ->get();
        $data['record'] = $this->model::withTrashed()
            ->with(['user', 'tags', 'category'])
            ->where('uuid', $id)
            ->first();
        $data['selectedTags'] = $data['record']->posts
            ->pluck('blog_tag_id')
            ->toArray();
        if (!$data['record']) :
            abort(404);
        endif;
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'update',
            'method' => 'put',
            'label' => 'ubah',
            'heading' => $data['record']->title,
        ];
        return view($this->view . '.form', $data);
    }

    public function update(BlogArticleRequest $request, string $id)
    {
        $record = $this->model::where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        if ($request->has('file')) :
            $path = 'article/' . now()->format('Y/m/');
            $temporary = $request->file;
            $newPath = $path . basename($temporary);
            if ($record->file) :
                Storage::disk('public')
                    ->delete($record->file);
            endif;
            Storage::disk('public')
                ->put($newPath, Storage::get($temporary));
            Storage::delete($temporary);
            $file = $newPath ?? null;
        endif;
        if ($request->has('attachment')) :
            $temporary = $request->attachment;
            $path = 'attachment/' . now()->format('Y/m/');
            $attachment = [];
            if ($record->attachment) :
                foreach ($record->attachment as $item) :
                    Storage::disk('public')
                        ->delete($item);
                endforeach;
            endif;
            foreach ($temporary as $item) :
                $newPath = $path . basename($item);
                Storage::disk('public')
                    ->put($newPath, Storage::get($item));
                Storage::delete($item);
                $attachment[] = $newPath;
            endforeach;
            $attachment = $attachment;
        endif;
        $record->update([
            'user_id' => Auth::user()->id ?? null,
            'blog_category_id' => $request->category ?? null,
            'slug' => Str::slug($request->title, '-') ?? null,
            'title' => $request->title ?? null,
            'content' => $request->content ?? null,
            'description' => $request->description ?? null,
            'file' => $file ?? null,
            'attachment' => $attachment ?? null,
            'is_show' =>  $request->is_show ? true : false,
            'published_at' => $request->published_at ?? null,
        ]);
        BlogPost::where('blog_article_id', $record->id)
            ->delete();
        if ($request->tag) :
            foreach ($request->tag as $item) :
                BlogPost::create([
                    'blog_article_id' => $record->id,
                    'blog_tag_id' => $item,
                ]);
            endforeach;
        endif;
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data diubah.')));
        return redirect()->route($this->route . '.index');
    }

    public function destroy(string $id)
    {
        $record = $this->model::where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        $record->delete();
        alert()->alert(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data dihapus.')));
        return redirect()->route($this->route . '.index');
    }

    public function trash(Request $request)
    {
        $data['record'] = $this->model::onlyTrashed()
            ->filter($request->only($this->scope))
            ->orderByDesc('id')
            ->paginate($this->pagination)
            ->withQueryString();
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'trash',
            'method' => 'put',
            'label' => 'sampah',
            'heading' => null,
        ];
        confirmDelete(Str::ucfirst(__('hapus permanen')), Str::ucfirst(__('anda yakin ingin menghapus data secara permanen?')));
        return view($this->view . '.list', $data);
    }

    public function restore(string $id)
    {
        $record = $this->model::withTrashed()
            ->where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        $record->restore();
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data dipulihkan.')));
        return redirect()->route($this->route . '.trash');
    }

    public function forceDelete(string $id)
    {
        $record = $this->model::withTrashed()
            ->where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        if ($record->file) :
            Storage::disk('public')
                ->delete($record->file);
        endif;
        if ($record->attachment) :
            foreach ($record->attachment as $item) :
                Storage::disk('public')
                    ->delete($item);
            endforeach;
        endif;
        $record->forceDelete();
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data dihapus permanen.')));
        return redirect()->route($this->route . '.trash');
    }
}
