<?php

namespace App\Services\Dashboard\Categories;

use App\Repositories\Dashboard\Categories\ICategoryRepository;
use Yajra\DataTables\Facades\DataTables;

class CategoryService implements ICategoryService
{
    private $iCategoryRepository;

    public function __construct(ICategoryRepository $iCategoryRepository)
    {
        $this->iCategoryRepository = $iCategoryRepository;
    }

    public function getCategoriesForDatatable()
    {
        $categories = $this->iCategoryRepository->allWithProductsCount();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('name', function ($category) {
                return $category->getTranslation('name', app()->getLocale());
            })
            ->addColumn('status', function ($category) {
                return $category->getStatusTranslated();
            })
            ->addColumn('products_count', function ($category) {
                return '<div class="badge badge-pill badge-border border-primary success lg">' . $category->products_count . '</div>';
            })
            ->addColumn('action', function ($category) {
                return view('dashboard.categories.actions', compact('category'));
            })
            ->rawColumns(['products_count', 'action'])
            ->make(true);
    }

    public function store(array $data)
    {
        return $this->iCategoryRepository->create($data);
    }

    public function findById($id)
    {
        return $this->iCategoryRepository->find($id);
    }

    public function update(array $data)
    {
        return $this->iCategoryRepository->update($data['id'], $data);
    }

    public function delete($id)
    {
        return $this->iCategoryRepository->delete($id);
    }

    public function getParentCategories()
    {
        return $this->iCategoryRepository->getParentCategories();
    }

    public function getCategoriesExceptChildren($id)
    {
        return $this->iCategoryRepository->getCategoriesExceptChildren($id);
    }
}
