<?php

namespace App\Http\Controllers\Private\Post;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Private\Post\BlogCategoryRequest;

class BlogCategoryController extends Controller
{
    private $model = BlogCategory::class;
    private $title = 'kategori';
    private $route = 'blog.category';
    private $view = 'private.blog.category';
    private $scope = ['search', 'start_date', 'end_date'];
    private $pagination = 10;

    public function index(Request $request)
    {
        $data['record'] = $this->model::filter($request->only($this->scope))
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
        $data['record'] = new $this->model;
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

    public function store(BlogCategoryRequest $request)
    {
        $this->model::create([
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->title, '-'),
            'title' => $request->title,
        ]);
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data disimpan.')));
        return redirect()->route($this->route . '.index');
    }

    public function show(string $id)
    {
        $data['record'] = $this->model::withTrashed()
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
        $data['record'] = $this->model::withTrashed()
            ->where('uuid', $id)
            ->first();
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

    public function update(BlogCategoryRequest $request, string $id)
    {
        $record = $this->model::where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        $record->update([
            'slug' => Str::slug($request->title, '-'),
            'title' => $request->title,
        ]);
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('berhasil diubah.')));
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
        $record->forceDelete();
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data dihapus permanen.')));
        return redirect()->route($this->route . '.trash');
    }
}
