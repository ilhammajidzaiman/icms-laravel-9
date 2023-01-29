<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Gate::define('admin', function (User $user) {
        //     return $user->level_id == 1;
        // });

        $segment1 = Request::segment(1);
        $segment2 = Request::segment(2);
        $segment3 = Request::segment(3);
        $segment4 = Request::segment(4);
        $segment5 = Request::segment(5);
        $segment2 === 'master' ? $segmentHref = $segment3 : $segmentHref = $segment2;
        $segment2 === 'master' ? $segmentForm = '/' . $segment1 . '/' . $segment2 . '/' . $segment3 : $segmentForm = '/' . $segment1 . '/' . $segment2;

        View::share(
            [
                'config'        => Config::where('id', 1)->first(),
                'segment1'      => $segment1,
                'segment2'      => $segment2,
                'segment3'      => $segment3,
                'segment4'      => $segment4,
                'segment5'      => $segment5,
                'segmentHref'   => $segmentHref,
                'segmentForm'   => $segmentForm,
            ]
        );
    }
}
