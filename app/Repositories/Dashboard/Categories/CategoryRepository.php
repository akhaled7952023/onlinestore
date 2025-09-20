<?php
namespace App\Repositories\Dashboard\Categories;

use App\Models\Category;
use App\Repositories\Base\BaseRepository;

class CategoryRepository extends BaseRepository implements   ICategoryRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
    public function getParentCategories()
    {
        return $this->model->whereNull('parent')->get();
    }

    public function getCategoriesExceptChildren($id)
    {
        return $this->model
            ->where('id', '!=', $id)
            ->whereNull('parent')
            ->get();
    }
    public function allWithProductsCount()
    {
        return $this->model->withCount('products')->get();
    }

}
