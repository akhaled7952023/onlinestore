<?php

namespace App\Repositories\Dashboard\Admins;

interface IAdminRepository
{
    public function createAdmin(array $data);
    public function updateAdmin($id, array $data);
    public function deleteAdmin($id);
    public function assignRole($adminId, $roleId);
    public function getRolesList();
}
