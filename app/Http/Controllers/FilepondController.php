<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FilepondController extends Controller
{
    public function upload(Request $request): string
    {
        $files = $request->allFiles();
        if (empty($files)) :
            abort(422, __('tidak ada berkas yang diunggah'));
        endif;
        if (count($files) > 1) :
            abort(422, __('hanya 1 berkas yang bisa diunggah'));
        endif;
        $requestKey = array_key_first($files);
        $file = is_array($request->input($requestKey)) ? $request->file($requestKey)[0] : $request->file($requestKey);
        return $file->storeAs(
            path: 'tmp',
            name: now()->format('YmdHis') . '-' .  Str::random(50) . '.' . $file->extension()
        );
    }
}
