<?php

namespace App\Services\Dashboard\Coupon;

use App\Repositories\Dashboard\Coupon\ICouponRepository;
use Yajra\DataTables\Facades\DataTables;

class CouponService implements ICouponService
{
    protected $iCouponRepository;
    public function __construct(ICouponRepository $iCouponRepository)
    {
        $this->iCouponRepository = $iCouponRepository;
    }

    public function getCoupon($id)
    {
        $coupon = $this->iCouponRepository->find($id);
        return $coupon ?? abort(404);
    }

    public function getCouponsForDataTable()
    {
        $coupons = $this->iCouponRepository->getLatestCoupons();

        return DataTables::of($coupons)
            ->addIndexColumn()
            ->addColumn('code_coupon', fn($row) => $row->code_coupon)
            ->addColumn('discount_type', fn($row) => __('dashboard.' . $row->discount_type))
            ->addColumn('discount_value', function ($row) {
                if ($row->discount_type === 'percentage') {
                    return app()->getLocale() === 'ar' ? $row->discount_value . '٪' : $row->discount_value . ' %';
                }
                return app()->getLocale() === 'ar' ? $row->discount_value . ' رس' : $row->discount_value . ' RS';
            })
            ->addColumn('is_active', fn($row) => $row->is_active ? __('dashboard.active') : __('dashboard.inactive'))
            ->addColumn('limit', fn($row) => $row->limit)
            ->addColumn('time_used', fn($row) => $row->time_used)
            ->addColumn('start_date', fn($row) => $row->start_date)
            ->addColumn('end_date', fn($row) => $row->end_date)
            ->addColumn('created_at', fn($row) => $row->created_at)
            ->addColumn('action', fn($coupon) => view('dashboard.coupons.datatables.actions', compact('coupon')))
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createCoupon($data)
    {
        return $this->iCouponRepository->create($data);
    }

    public function updateCoupon($id, $data)
    {
        // $coupon = $this->getCoupon($id);
        return $this->iCouponRepository->update($id, $data);
    }

    public function deleteCoupon($id)
    {
        // $coupon = $this->getCoupon($id);
        return $this->iCouponRepository->delete($id);
    }
}
