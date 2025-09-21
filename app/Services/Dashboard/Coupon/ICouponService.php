<?php

namespace App\Services\Dashboard\Coupon;

interface ICouponService
{
     public function getCoupon($id);
     public function getCouponsForDataTable();
     public function createCoupon($data);
      public function updateCoupon($id, $data);
     public function deleteCoupon($id);
}
