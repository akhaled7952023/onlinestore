<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\Translatable\HasTranslations;

class Governrate extends Model
{
    use HasTranslations;
    use HasFactory;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'country_id' , 'is_active'];

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class , 'governorate_id');
    }



    public function users()
    {
        return $this->hasMany(User::class , 'governorate_id');
    }
    public function getIsActiveAttribute($value)
    {
        if(Config::get('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';

        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
