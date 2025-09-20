<?php

namespace App\Services\Dashboard\Brand;

interface IBrandService
{

    public function getBrandsForDatatable();
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function findById(int $id);
 }
