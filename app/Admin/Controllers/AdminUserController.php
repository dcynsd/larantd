<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminUser;
use App\Admin\Models\AdminPermission;
use App\Admin\Requests\AdminUserRequest;
use App\Admin\Resources\AdminUserResource;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $data = AdminUser::query()
            ->filter($request->all())
            ->with('permissions:id,name', 'roles:id,name')
            ->paginate();

        return $this->response->success(AdminUserResource::collection($data));
    }

    public function create()
    {
        return $this->response->success([
            'roles' => AdminRole::select('id', 'name')->get(),
            'permissions' => AdminPermission::select('id', 'name')->get(),
        ]);
    }

    public function store(AdminUserRequest $request)
    {
        $adminUser = AdminUser::create($request->validated());

        $adminUser->syncRoleAndPermission();

        return $this->response->created();
    }

    public function update(AdminUser $adminUser, AdminUserRequest $request)
    {
        $adminUser->update($request->validated());

        $adminUser->syncRoleAndPermission();

        return $this->response->created();
    }

    public function destroy(AdminUser $adminUser)
    {
        $adminUser->permissions()->detach();
        $adminUser->roles()->detach();
        $adminUser->delete();

        return $this->response->noContent();
    }
}
