<?php
namespace App\Repositories\Dashboard\Coupon;

use App\Models\Coupon;
use App\Repositories\Base\BaseRepository;

class CouponRepository extends BaseRepository implements ICouponRepository
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }

    public function getLatestCoupons()
    {
        return $this->model->latest()->get();
    }
}
