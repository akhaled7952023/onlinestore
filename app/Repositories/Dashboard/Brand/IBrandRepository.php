<?php
namespace App\Repositories\Dashboard\Brand;

use App\Repositories\Base\IBaseRepositoryInterface;

interface  IBrandRepository extends IBaseRepositoryInterface
{
        public function allBrandsWithProductsCount();

}
