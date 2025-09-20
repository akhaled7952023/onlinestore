<?php
namespace App\Repositories\Dashboard\Categories;

use App\Repositories\Base\IBaseRepositoryInterface;

interface  ICategoryRepository extends IBaseRepositoryInterface
{

    public function getParentCategories();
    public function getCategoriesExceptChildren($id);
    public function allWithProductsCount();

}
