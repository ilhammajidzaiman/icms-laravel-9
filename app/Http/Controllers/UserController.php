<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Enums\GenderEnum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Private\Setting\UserRequest;

class UserController extends Controller
{
    private $model = User::class;
    private $title = 'user';
    private $route = 'setting.user';
    private $view = 'private.setting.user';
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
        $data['roles'] = Role::all();
        $data['gender'] = GenderEnum::cases();
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

    public function store(UserRequest $request)
    {
        if ($request->has('file')) :
            $path = 'user/' . now()->format('Y/m/');
            $temporary = $request->file;
            $filePath = $path . basename($temporary);
            Storage::disk('public')
                ->put($filePath, Storage::get($temporary));
            Storage::delete($temporary);
            $file = $filePath ?? null;
        endif;
        $user = $this->model::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Profile::create([
            'user_id' => $user->id,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'file' => $file ?? null,
        ]);
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('data disimpan.')));
        return redirect()->route($this->route . '.index');
    }

    public function show(string $id)
    {
        $data['record'] = $this->model::withTrashed()
            ->with('profile')
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
        $data['gender'] = GenderEnum::cases();
        $data['record'] = $this->model::withTrashed()
            ->with('profile')
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

    public function update(UserRequest $request, string $id)
    {
        $record = $this->model::where('uuid', $id)
            ->first();
        if (!$record) :
            abort(404);
        endif;
        if ($request->has('file')) :
            $path = 'user/' . now()->format('Y/m/');
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
            'name' => $request->name ?? null,
            'username' => $request->username ?? null,
            'email' => $request->email ?? null,
        ]);
        Profile::where('user_id', $record->id)
            ->update([
                'birth_date' => $request->birth_date ?? null,
                'gender' => $request->gender ?? null,
                'file' => $file ?? null,
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

    public function password(string $id)
    {
        $data['record'] = $this->model::withTrashed()->where('uuid', $id)->first();
        if (!$data['record']) :
            abort(404);
        endif;
        $data['page'] = (object)[
            'title' => $this->title,
            'route' => $this->route,
            'routeName' => 'password',
            'method' => 'put',
            'label' => 'reset password',
            'heading' => $data['record']->title,
        ];
        return view($this->view . '.reset-password', $data);
    }

    public function reset(Request $request, string $id)
    {
        $record = $this->model::withTrashed()->where('uuid', $id)->first();
        if (!$record) :
            abort(404);
        endif;
        $password = Hash::make($request->password);
        $request->validate([
            'password' => 'required|max:255|min:6|same:password_confirmation',
            'password_confirmation' => 'required|max:255|min:6|same:password',
        ]);
        $record->update([
            'password' => $password,
        ]);
        alert()->success(Str::ucfirst(__('berhasil')), Str::ucfirst(__('kata sandi telah diatur ulang.')));
        return redirect()->route($this->route . '.index');
    }
}
