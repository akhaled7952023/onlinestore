<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code_coupon',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'min_cart_value',
        'limit',
        'time_used',
        'is_active',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }

    public function scopeValid($query)
    {
        return $query->where('is_active', 1)
            ->whereColumn('time_used', '<', 'limit')
            ->where('end_date', '>', now());
    }

    public function scopeNotValid($query)
    {
        return $query->where('is_active', 0)
            ->orWhereColumn('time_used', '>=', 'limit')
            ->orWhere('end_date', '<', now());
    }

    public function couponIsValid()
    {
        return $this->is_active == 1
            && $this->time_used < $this->limit
            && $this->end_date > now();
    }

    public function couponIsValidForCart($cartTotal)
{
    return $this->couponIsValid() &&
           (is_null($this->min_cart_value) || $cartTotal >= $this->min_cart_value);
}

    public function status()
    {
        return $this->is_active == 1 ? 'Active' : 'Inactive';
    }
}
