<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\shippingPriceRequest;
use App\Services\Dashboard\World\IWorldService;
use Illuminate\Http\Request;

class WordlController extends Controller
{

    protected $iWorldService;
    public function __construct(IWorldService $iWorldService)
    {
        $this->iWorldService = $iWorldService;
    }


    public function getAllCountries()
    {
        $countries =  $this->iWorldService->getAllCountries();
        return view('dashboard.world.countries', compact('countries'));
    }

    public function getGovByCountryId($id)
    {
        $governorates =  $this->iWorldService->getAllGovernorates($id);
        return view('dashboard.world.governorates', compact('governorates'));
    }

    public function getCitiesByGovId($id)
    {
        $cities =  $this->iWorldService->getAllCities($id);
        return view('dashboard.world.cities', compact('cities'));
    }

    public function getAllGovernoratesInSystem()
    {
        $governorates =  $this->iWorldService->getAllGovernoratesInSystem();
        return view('dashboard.world.governorates', compact('governorates'));
    }
    public function getAllCitiesInSystem()
    {
        $cities =  $this->iWorldService->getAllCitiesInSystem();
        return view('dashboard.world.cities', compact('cities'));
    }



    public function changeStatus($country_id)
    {
        $country = $this->iWorldService->changeStatus($country_id);
        if (!$country) {
            return response()->json([
                'status' => false,
                'message' => __('dashboard.error_msg')
            ], 404);
        }
        $country = $this->iWorldService->getCountryById($country_id);
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $country
        ], 200);
    }


    public function changeGovStatus($gov_id)
    {
        $gov = $this->iWorldService->changeGovStatus($gov_id);
        if (!$gov) {
            return response()->json([
                'status' => false,
                'message' => __('dashboard.error_msg')
            ], 404);
        }
        $gov = $this->iWorldService->getGovernorateById($gov_id);
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $gov
        ], 200);
    }
    public function changeCityStatus($city_id)
{
    $city = $this->iWorldService->changeCityStatus($city_id);

    if (!$city) {
        return response()->json([
            'status' => false,
            'message' => __('dashboard.error_msg')
        ], 404);
    }

    $city = $this->iWorldService->getCityById($city_id);

    return response()->json([
        'status'  => 'success',
        'message' => __('dashboard.success_msg'),
        'data'    => $city
    ], 200);
}

     public function getCityById($cityId){
        return $this->iWorldService->getCityById($cityId);
    }

    public function getActiveCities()
{
    $cities = $this->iWorldService->getActiveGovernorateCities();
    return view('dashboard.world.cities', compact('cities'));
}

    public function changeShippingPrice(shippingPriceRequest $request)
{
    if (!$this->iWorldService->changeShippingPrice($request)) {
        return response()->json([
            'status' => false,
            'message' => __('dashboard.error_msg')
        ], 404);
    }

    $city = $this->iWorldService->getCityById($request->city_id);

    $city->load('shippingPrice');

    return response()->json([
        'status'  => 'success',
        'message' => __('dashboard.success_msg'),
        'data'    => $city
    ], 200);
}

public function searchCities(Request $request)
{
    $keyword = $request->get('keyword');
    $cities  = $this->iWorldService->searchCities($keyword);

    return view('dashboard.world.partials.cities_table', compact('cities'))->render();
}




}
