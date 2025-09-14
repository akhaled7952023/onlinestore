<?php

namespace App\Services\Dashboard\Admins;

use App\Repositories\Dashboard\Admins\IAdminRepository;

class AdminService implements IAdminService
{
    protected $adminRepo;

    public function __construct(IAdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function createAdmin(array $data)
    {
        return $this->adminRepo->createAdmin($data);
    }

    public function updateAdmin($id, array $data)
    {
        return $this->adminRepo->updateAdmin($id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->adminRepo->deleteAdmin($id);
    }

    public function getRolesList()
    {
        return $this->adminRepo->getRolesList();
    }
}
