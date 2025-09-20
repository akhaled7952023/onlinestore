<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Services\Dashboard\Brand\IBrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    protected $iBrandService;
    public function __construct(IBrandService $iBrandService)
    {
     $this->iBrandService = $iBrandService;
    }
    public function index()
    {
        return view('dashboard.brands.index');
    }

    public function getAll()
{
    return $this->iBrandService->getBrandsForDatatable();
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest  $request)
    {
         $data = $request->only(['name', 'status', 'logo']);
        $brand = $this->iBrandService->store($data);

        if(!$brand){
            Session::flash('error' , trans('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , trans('dashboard.success_msg'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
{
    $brand = $this->iBrandService->findById($id);
    return view('dashboard.brands.edit', compact('brand'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $data = $request->only(['name', 'status', 'logo']);

        $brand = $this->iBrandService->update($id , $data);
        if(!$brand){
            Session::flash('error' , trans('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , trans('dashboard.success_msg'));
         return redirect()->route('dashboard.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->iBrandService->delete($id)){
            Session::flash('error' , trans('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , trans('dashboard.success_msg'));
        return redirect()->back();
    }
}
