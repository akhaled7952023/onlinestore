<?php
namespace App\Repositories\Dashboard\Admins;

use App\Models\Admin;
use App\Repositories\Base\BaseRepository;
use Spatie\Permission\Models\Role;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
    public function createAdmin(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $admin = $this->create($data);

        if (isset($data['type'])) {
            $this->assignRole($admin->id, $data['type']);
        }

        return $admin;
    }

    public function updateAdmin($id, array $data)
    {
        $admin = $this->model->find($id);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $admin->update($data);

        if (isset($data['type'])) {
          $this->assignRole($admin->id, $data['type']);
        }

        return $admin;
    }
    public function deleteAdmin($id)
    {
        return $this->delete($id);
    }

    public function assignRole($adminId, $roleId)
    {
        $admin = $this->model->find($adminId);
        $role = Role::find($roleId);

        if (!$admin || !$role) {
            return false;
        }
        $admin->syncRoles([$role->name]);
        return true;
    }

    public function getRolesList()
    {
        return Role::select('id', 'name', 'name_ar')
        ->where('id', '!=', 1)
        ->get();
    }
}
