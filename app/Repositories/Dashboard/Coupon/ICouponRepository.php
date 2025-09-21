<?php
namespace App\Repositories\Dashboard\Coupon;

use App\Repositories\Base\IBaseRepositoryInterface;

interface  ICouponRepository extends IBaseRepositoryInterface
{
    public function getLatestCoupons();
}
