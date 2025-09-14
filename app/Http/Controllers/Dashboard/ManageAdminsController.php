<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMakeAdminRequest;
use App\Http\Requests\UpdateMakeAdminRequest;
use App\Http\Requests\UpdateProfileAdminRequest;
use App\Models\Admin;
use App\Services\Dashboard\Admins\IAdminService;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageAdminsController extends Controller
{
    use AuthorizesRequests;
    protected $adminService;

    public function __construct(IAdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index()
    {
        $this->authorize('viewAny', Admin::class);
        $currentAdminId = auth('admin')->id();
        $admins = Admin::with('roles')->where('id', '!=', $currentAdminId)->where('id', '!=', 1)->paginate(10);
        return view('dashboard.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->authorize('create', Admin::class);
        $roles = $this->adminService->getRolesList();
        return view('dashboard.admins.create', compact('roles'));
    }

    public function show($id) {}

    public function edit($id)
    {
        $admin = Admin::find($id);
        $this->authorize('update', $admin);
        if (!$admin) {
            return back()->with('error', __('dashboard.error_msg'));
        }
        $roles = $this->adminService->getRolesList();
        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

    public function update($id, UpdateMakeAdminRequest $request)
    {
        $admin = Admin::findOrFail($id);
        $this->authorize('update', $admin);
        if (!$admin) {
            return back()->with('error', __('dashboard.error_msg'));
        }
        $updated = $this->adminService->updateAdmin($id, $request->validated());
        if (!$updated) {
            return back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('dashboard.success_msg'));
    }

    public function store(CreateMakeAdminRequest $request)
    {
        $this->authorize('create', Admin::class);

        $admin = $this->adminService->createAdmin($request->validated());

        if (!$admin) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.admins.index')->with('success', __('dashboard.success_msg'));
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $this->authorize('delete', $admin);
        try {
            DB::beginTransaction();

            if (!$admin) {
                return back()->with('error', __('dashboard.error_msg'));
            }
            $admin->syncRoles([]);
            $admin->delete();
            DB::commit();
            return redirect()->route('dashboard.admins.index')->with('success', __('dashboard.success_msg'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('dashboard.error_msg'));
        }
    }

    public function profile()
    {
        $admin = auth('admin')->user();
        return view('dashboard.admins.profile', compact('admin'));
    }

    public function updateProfile(UpdateProfileAdminRequest $request)
{
    $admin = auth('admin')->user();
    $data = $request->validated();
    if (empty(trim($data['password'] ?? ''))) {
    unset($data['password']);
    unset($data['password_confirmation']);
}

    $updated = $this->adminService->updateAdmin($admin->id, $data);

    if (!$updated) {
        return back()->with('error', __('dashboard.error_msg'));
    }

    return redirect()->route('dashboard.welcome')
                     ->with('success', __('dashboard.success_msg'));
}


}
