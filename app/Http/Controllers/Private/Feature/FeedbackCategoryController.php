<?php

namespace App\Http\Controllers\Private\Feature;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature\FeedbackCategory;

class FeedbackCategoryController extends Controller
{
    private $model = FeedbackCategory::class;
    private $title = 'kategori';
    private $route = 'feature.category';
    private $view = 'private.feature.feedback-category';
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
