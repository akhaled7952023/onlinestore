<?php
namespace App\Repositories\Dashboard\World;

use App\Repositories\Base\BaseRepository;

interface  IWorldRepository
{

    public function getCountryById($id);
    public function getGovernorateById($id);
    public function getAllCountries();
    public function getAllgovernorates($country);
    public function getAllCities($governorate);
    public function changeStatus($model);
    public function changeShippingPrice($governorate , $price);
    public function getCityById($cityId);
    public function getActiveGovernorateCities();
    public function getAllGovernoratesInSystem();
    public function getAllCitiesInSystem();
     public function searchCities($keyword);


}
