<?php

namespace App\Http\Controllers\Private;

use App\Models\Post\Page;
use App\Models\Post\BlogTag;
use App\Models\Post\BlogArticle;
use App\Models\Post\BlogCategory;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data['countArticle'] = (object)[
            'value' => BlogArticle::all()->count(),
            'label' => 'jumlah artikel',
        ];
        $data['countTag'] = (object)[
            'value' => BlogTag::all()->count(),
            'label' => 'jumlah topik',
        ];
        $data['countCategory'] = (object)[
            'value' => BlogCategory::all()->count(),
            'label' => 'jumlah kategori',
        ];
        $data['countPage'] = (object)[
            'value' => Page::all()->count(),
            'label' => 'jumlah halaman',
        ];
        return view('private.dashboard', $data);
    }
}
