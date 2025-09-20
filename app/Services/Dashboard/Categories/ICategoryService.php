<?php

namespace App\Services\Dashboard\Categories;

interface ICategoryService
{

    public function getCategoriesForDatatable();
    public function store(array $data);
    public function findById($id);
    public function update(array $data);
    public function delete($id);
    public function getParentCategories();
    public function getCategoriesExceptChildren($id);
 }
