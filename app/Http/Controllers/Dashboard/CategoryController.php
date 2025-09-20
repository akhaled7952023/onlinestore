<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Dashboard\Categories\ICategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $iCategoryService;

    public function __construct(ICategoryService $iCategoryService)
    {
        $this->iCategoryService = $iCategoryService;
    }

    // public function index()
    // {
    //     return view('dashboard.categories.index');
    // }
    public function index()
    {
        $edit_categories = $this->iCategoryService->getCategoriesExceptChildren(1);
        return view('dashboard.categories.index', compact('edit_categories'));
    }

    public function getAll()
    {
        return $this->iCategoryService->getCategoriesForDatatable();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->iCategoryService->getParentCategories();
        return view('dashboard.categories.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only(['name', 'parent', 'status']);
        if (!$this->iCategoryService->store($data)) {
            Session::flash('error', __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success', __('dashboard.success_msg'));
        return view('dashboard.categories.index');
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
        $category = $this->iCategoryService->findById($id);
        $categories = $this->iCategoryService->getCategoriesExceptChildren($id);
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->only(['name', 'parent', 'status', 'id']);
        if (!$this->iCategoryService->update($data)) {
            Session::flash('error', __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success', __('dashboard.success_msg'));
         return view('dashboard.categories.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->iCategoryService->delete($id)) {
            Session::flash('error', __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success', __('dashboard.success_msg'));
        return redirect()->back();
    }
}
