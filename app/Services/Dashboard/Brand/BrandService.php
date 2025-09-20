<?php

namespace App\Services\Dashboard\Brand;

use App\Repositories\Dashboard\Brand\IBrandRepository;
use App\Utils\ImageManger;
use Yajra\DataTables\Facades\DataTables;

class BrandService implements IBrandService
{
    private $iBrandsRepository, $imageManger;

    public function __construct(IBrandRepository $iBrandsRepository, ImageManger $imageManger)
    {
        $this->iBrandsRepository = $iBrandsRepository;
        $this->imageManger = $imageManger;
    }

    public function getBrandsForDatatable()
    {
        $brands = $this->iBrandsRepository->AllBrandsWithProductsCount();
        return DataTables::of($brands)
            ->addIndexColumn()
            ->addColumn('name', function ($brand) {
                return $brand->getTranslation('name', app()->getLocale());
            })
            ->addColumn('status', function ($brand) {
                return $brand->getStatus();
            })
            ->addColumn('products_count', function ($brand) {
                return '<div class="badge badge-pill badge-border border-primary success lg">' . $brand->products_count . '</div>';
            })
            ->addColumn('logo', function ($brand) {
                return view('dashboard.brands.logo', compact('brand'));
            })
            ->addColumn('action', function ($brand) {
                return view('dashboard.brands.actions', compact('brand'));
            })
            ->rawColumns(['products_count', 'action', 'logo'])
            ->make(true);
    }

    public function store(array $data)
    {
        if (isset($data['logo']) && $data['logo'] != null) {
            $file_name = $this->imageManger->uploadSingleImage('/', $data['logo'], 'brands');
            $data['logo'] = $file_name;
        }

        return $this->iBrandsRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $brand = $this->iBrandsRepository->find($id);
        if (!$brand) {
            abort(404, 'Brand not found');
        }
        if (isset($data['logo']) && $data['logo'] != null) {
            $this->imageManger->deleteImageFromLocal($brand->logo);
            $file_name = $this->imageManger->uploadSingleImage('/', $data['logo'], 'brands');
            $data['logo'] = $file_name;
        }
        return $this->iBrandsRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $brand = $this->iBrandsRepository->find($id);

        if (!$brand) {
            abort(404, 'Brand not found');
        }

        if ($brand->logo != null) {
            $this->imageManger->deleteImageFromLocal($brand->logo);
        }
        return $this->iBrandsRepository->delete($id);
    }
    public function findById(int $id)
    {
        return $this->iBrandsRepository->find($id);
    }


}
