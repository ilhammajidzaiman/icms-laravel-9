<?php

namespace App\Http\Controllers\Private\Post;

use App\Models\Post\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Private\Post\PageRequest;

class PageController extends Controller
{
    private $model = Page::class;
    private $title = 'halaman';
    private $route = 'blog.page';
    private $view = 'private.blog.page.';
    private $scope = ['search', 'start_date', 'end_date'];

    public function index(Request $request)
    {
        $data['record'] = $this->model::filter($request->only($this->scope))
            ->with(['user'])
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'index',
            'method' => null,
            'label' => 'daftar',
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
        return view($this->view . '.', $data);
    }

    public function store(PageRequest $request)
    {
        if ($request->has('file')) :
            $path = 'page/' . now()->format('Y/m/');
            $temporary = $request->file;
            $filePath = $path . basename($temporary);
            Storage::disk('public')
                ->put($filePath, Storage::get($temporary));
            Storage::delete($temporary);
            $file = $filePath ?? null;
        endif;
        $this->model::create([
            'user_id' => Auth::user()->id ?? null,
            'slug' => Str::slug($request->title, '-') ?? null,
            'title' => $request->title ?? null,
            'content' => $request->content ?? null,
            'file' => $file ?? null,
            'is_show' => true,
        ]);
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data disimpan.')));
        return redirect()->route($this->route . '.index');
    }

    public function show(string $id)
    {
        $data['record'] = $this->model::withTrashed()
            ->with(['user'])
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
            ->with(['user'])
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

    public function update(PageRequest $request, string $id)
    {
        $record = $this->model::where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        if ($request->has('file')) :
            $path = 'page/' . now()->format('Y/m/');
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
        $record->update([
            'user_id' => Auth::user()->id ?? null,
            'slug' => Str::slug($request->title, '-') ?? null,
            'title' => $request->title ?? null,
            'content' => $request->content ?? null,
            'is_show' => true,
            'file' => $file ?? null,
        ]);
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
            ->paginate(10)
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
        return redirect()->route("{$this->route}.trash");
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
        $record->forceDelete();
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data dihapus permanen.')));
        return redirect()->route("{$this->route}.trash");
    }
}
