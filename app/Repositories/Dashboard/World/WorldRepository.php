<?php
namespace App\Repositories\Dashboard\World;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;

class WorldRepository  implements IWorldRepository
{
    public function getCountryById($id)
    {
        return Country::find($id);
    }

    public function getGovernorateById($id)
    {
        return Governrate::find($id);
    }

    public function getAllCountries()
    {
        //Eagr Loading
        $country =  Country::withCount(['governorates', 'users'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->paginate(5);
            return $country;
    }

    public function getAllgovernorates($country)
    {
        $governorate =  $country->governorates()
            ->with(['country'])
            ->withCount(['cities', 'users'])
            ->paginate(10);

        return $governorate;
    }

    public function getAllGovernoratesInSystem()
    {
        $governorate = Governrate::with(['country', ])
            ->withCount(['cities', 'users'])
            ->paginate(10);

        return $governorate;
    }

    public function getAllCities($governorate)
    {
        return $governorate->cities()
            ->with(['governorate', 'shippingPrice'])
            ->withCount(['users'])
            ->paginate(10);
    }

    public function getAllCitiesInSystem()
    {
        $city =  City::with(['governorate', 'shippingPrice'])
            ->withCount(['users'])
            ->paginate(10);
        return $city;
    }

    public function getCityById($cityId)
    {
        return City::with(['governorate', 'shippingPrice'])
            ->withCount(['users'])
            ->find($cityId);
    }

    public function getActiveGovernorateCities()
    {
        return City::with(['governorate', 'shippingPrice'])
            ->withCount(['users'])
            ->whereHas('governorate', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();
    }

    public function changeStatus($model)
    {
        return $model->update([
            'is_active' => $model->is_active == 'Active' || $model->is_active == 'مفعل' ? 0 : 1,
        ]);
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
            ->withCount(['users'])
            ->where('name', 'like', "%{$keyword}%")
            ->get();
    }
}
