<?php
namespace App\Repositories\Dashboard\Brand;

use App\Models\Brand;
use App\Repositories\Base\BaseRepository;

class BrandRepository extends BaseRepository implements IBrandRepository
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function allBrandsWithProductsCount()
{
    return $this->model->withCount('products')->latest()->get();
}

}
