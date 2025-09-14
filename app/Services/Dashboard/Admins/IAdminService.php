<?php

namespace App\Services\Dashboard\Admins;

interface IAdminService
{
    public function createAdmin(array $data);
    public function updateAdmin($id, array $data);
    public function deleteAdmin($id);
    public function getRolesList();
}
