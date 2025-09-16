<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingGovernorate extends Model
{
    protected $table = 'shipping_governorates';

    protected $fillable = [
        'price',
        'city_id',
    ];

}
