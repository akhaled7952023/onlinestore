<?php

namespace App\Services\Dashboard\World;

use App\Repositories\Dashboard\World\IWorldRepository;

class WorldService implements IWorldService
{
     protected $iWorldRepository;
    public function __construct(IWorldRepository $iWorldRepository)
    {
        $this->iWorldRepository = $iWorldRepository;
    }

     public function getCountryById($id)
    {
        $country = $this->iWorldRepository->getCountryById($id);
        if(!$country){
            abort(404);
        }
        return $country;
    }
    public function getGovernorateById($id)
    {
        $governorate = $this->iWorldRepository->getGovernorateById($id);
        if(!$governorate){
            abort(404);
        }
        return $governorate;
    }

    public function getAllCountries()
    {
        return $this->iWorldRepository->getAllCountries();
    }

    public function getAllGovernorates($id)
    {
        $country = self::getCountryById($id);
        return $this->iWorldRepository->getAllGovernorates($country);
    }
    public function getAllGovernoratesInSystem()
    {
        return $this->iWorldRepository->getAllGovernoratesInSystem();
    }
    public function getAllCitiesInSystem()
    {
        return $this->iWorldRepository->getAllCitiesInSystem();
    }


    public function getAllCities($governorate_id)
    {
        $governorate = self::getGovernorateById($governorate_id);
        return $this->iWorldRepository->getAllCities($governorate);
    }


    public function changeStatus($country_id)
    {
        $country = self::getCountryById($country_id);
        $country = $this->iWorldRepository->changeStatus($country);

        if(!$country){
            return false;
        }
        return true;
    }
    public function changeGovStatus($gov_id)
    {
        $gov = self::getGovernorateById($gov_id);
        $gov = $this->iWorldRepository->changeStatus($gov);

        if(!$gov){
            return false;
        }
        return true;
    }

    public function changeCityStatus($city_id)
{
    $city = self::getCityById($city_id);
        $city = $this->iWorldRepository->changeStatus($city);

        if(!$city){
            return false;
        }
        return true;
}

    public function getCityById($cityId){
        $city = $this->iWorldRepository->getCityById($cityId);
        if(!$city){
            abort(404);
        }
        return $city;
    }

    public function getActiveGovernorateCities()
    {
        return $this->iWorldRepository->getActiveGovernorateCities();
    }

    public function changeShippingPrice($request)
    {
        $city  = self::getCityById($request->city_id);
        $city  = $this->iWorldRepository->changeShippingPrice($city ,$request->price);
        if(!$city ){
            return false;
        }
        return true;
    }

    public function searchCities($keyword)
    {
        return $this->iWorldRepository->searchCities($keyword);
    }

}
