<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
     use HasTranslations;
     use HasFactory;

    public $translatable = ['name'];
    protected $fillable = ['name', 'governorate_id' , 'is_active'];

    public $timestamps = false;

    public function governorate()
    {
        return $this->belongsTo(Governrate::class, 'governorate_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }
     public function shippingPrice()
    {
        return $this->hasOne(ShippingGovernorate::class , 'city_id');
    }
     public function getIsActiveAttribute($value)
    {
        if(Config::get('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';

        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
