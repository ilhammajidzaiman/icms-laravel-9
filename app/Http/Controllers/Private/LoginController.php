<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return view('private.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // validation credential...
        $credentials = $request->validate([
            'email'         => ['required', 'email'],
            'password'      => ['required'],
        ]);

        if (Auth::attempt($credentials)) :
            $request->session()->regenerate();
            $statusId       = auth()->user()->user_status_id;
            $levelId        = auth()->user()->user_level_id;
            $level          = Str::replace(' ', '', Str::lower(auth()->user()->level->name));
            if ($statusId == 1) :
                if ($levelId == 1) :
                    return redirect()->intended()->route($level . '.dashboard');
                elseif ($levelId == 2) :
                    return redirect()->intended()->route($level . '.dashboard');
                elseif ($levelId == 3) :
                    return redirect()->intended()->route($level . '.dashboard');
                endif;
            else :
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $flashData = [
                    'message'       => 'Akun anda tidak aktif, Silahkan hubungi Admin!',
                    'alert'         => 'danger',
                    'icon'          => 'fa-fw fas fa-times',
                ];
                return back()->with($flashData);
            endif;
        endif;

        $flashData = [
            'message'       => 'Email atau password salah!',
            'alert'         => 'danger',
            'icon'          => 'fa-fw fas fa-times',
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
            'message'       => 'Anda telah logout!',
            'alert'         => 'primary',
            'icon'          => 'fa-fw fas fa-sign-out-alt',
        ];
        return redirect()->route('auth.login')->with($flashData);
    }
}
