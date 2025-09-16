<?php

namespace App\Services\Dashboard\World;

interface IWorldService
{

    public function getCountryById($id);
    public function getGovernorateById($id);
    public function getAllCountries();
    public function getAllGovernorates($id);
    public function getAllCities($governorate_id);
    public function getCityById($cityId);
    public function changeStatus($country_id);
    public function changeGovStatus($gov_id);
    public function changeShippingPrice($request);
    public function changeCityStatus($city_id);
    public function getActiveGovernorateCities();
    public function getAllGovernoratesInSystem();
    public function getAllCitiesInSystem();
    public function searchCities($keyword);

}
