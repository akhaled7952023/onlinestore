<?php
namespace App\Repositories\Dashboard\World;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;

class WorldRepository  implements IWorldRepository
{

    public function getCountryById($id)
    {
        $country = Country::find($id);
        return $country;
    }
    public function getGovernorateById($id)
    {
        $governorate = Governrate::find($id);
        return $governorate;
    }
    public function getAllCountries()
    {
        $countries = Country::when(!empty(request()->keyword),function($query){
              $query->where('name', 'like', '%'.request()->keyword.'%');
        })->select('id', 'name', 'phone_code' , 'is_active' , 'flag_code')->paginate(5);

        return $countries;
    }
    public function getAllgovernorates($country)
    {
        $governorates = $country->governorates()->paginate(10);
        return $governorates;
    }
    public function getAllGovernoratesInSystem()
{
    return Governrate::paginate(10);
}

    public function getAllCities($governorate)
    {
         return $governorate->cities()->paginate(10);
    }
    public function getAllCitiesInSystem()
{
    return City::paginate(10);
}

    public function getCityById($cityId)
{
    return City::find($cityId);
}
    public function getActiveGovernorateCities()
    {
        return City::whereHas('governorate', function ($query) {
            $query->where('is_active', 1);
        })->get();
    }

    public function changeStatus($model)
    {
        $model = $model->update([
            'is_active' => $model->is_active == 'Active' || $model->is_active == 'مفعل' ? 0 : 1,
        ]);

        return $model;

    }

    public function changeShippingPrice($governorate , $price)
    {
        return $governorate->shippingPrice->update([
            'price' => $price,
        ]);
    }

    public function searchCities($keyword)
    {
        return City::with(['governorate', 'shippingPrice'])
                   ->where('name', 'like', "%{$keyword}%")
                   ->get() ;
    }
}
