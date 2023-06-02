<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        // Paginator::useBootstrapFive();

        // Gate::define('developer', function (User $user) {
        //     return $user->user_level_id == 1;
        // });
        // Gate::define('admin', function (User $user) {
        //     return $user->user_level_id == 2;
        // });
        // Gate::define('user', function (User $user) {
        //     return $user->user_level_id == 3;
        // });
        // Gate::define('wartawan', function (User $user) {
        //     return $user->user_level_id == 4;
        // });

        $segment1 = Request::segment(1);
        $segment2 = Request::segment(2);
        $segment3 = Request::segment(3);
        $segment4 = Request::segment(4);
        $segment5 = Request::segment(5);
        $segment6 = Request::segment(6);
        $segment7 = Request::segment(7);
        $segment8 = Request::segment(8);

        // segmentLink
        $segmentLink = $segment1 . '/' . $segment2 . '/' . $segment3 . '/' . $segment4 . '/' . $segment5 . '/' . $segment6 . '/' . $segment7 . '/' . $segment8;

        // segmentPrefix
        $segment2 === 'management' || 'master' ? $segmentPrefix = $segment3 : $segmentPrefix = $segment2;

        // segmentUrl
        $segment2 === 'management' || 'master' ? $segmentUrl = '/' . $segment1 . '/' . $segment2 . '/' . $segment3 : $segmentUrl = '/' . $segment1 . '/' . $segment2;

        View::share(
            [
                'segment1'      => $segment1,
                'segment2'      => $segment2,
                'segment3'      => $segment3,
                'segment4'      => $segment4,
                'segment5'      => $segment5,
                'segment6'      => $segment6,
                'segment7'      => $segment7,
                'segment8'      => $segment8,
                'segmentLink'   => $segmentLink,
                'segmentPrefix' => $segmentPrefix,
                'segmentUrl'    => $segmentUrl,
            ]
        );
    }
}
