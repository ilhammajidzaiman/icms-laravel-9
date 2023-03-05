<?php

namespace App\Http\Controllers\Private;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'controller'    => 'login',
            'title'         => 'login',
        ];
        return view('private.login', $data);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'         => ['required', 'email'],
            'password'      => ['required'],
        ]);

        if (Auth::attempt($credentials)) :
            $request->session()->regenerate();
            $statusId       = auth()->user()->status_id;
            $levelId        = auth()->user()->level_id;

            if ($statusId == 1) :
                if ($levelId == 1) :
                    return redirect()->intended('developer/dashboard');
                elseif ($levelId == 2) :
                    return redirect()->intended('admin/dashboard');
                elseif ($levelId == 3) :
                    return redirect()->intended('user/dashboard');
                endif;
            else :
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $flashData = [
                    'message'       => 'Akun anda tidak aktif, Silahkan hubungi Admin!',
                    'alert'         => 'danger',
                ];
                return back()->with($flashData);
            endif;
        endif;

        $flashData = [
            'message'       => 'Email atau password salah!',
            'alert'         => 'danger',
        ];
        return back()->with($flashData);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $flashData = [
            'message'       => 'Anda telah keluar!',
            'alert'         => 'warning',
        ];
        return redirect('/login')->with($flashData);
    }
}
