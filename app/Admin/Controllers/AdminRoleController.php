<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminPermission;
use App\Admin\Requests\AdminRoleRequest;
use App\Admin\Resources\AdminRoleResource;

class AdminRoleController extends Controller
{
    public function index(Request $request)
    {
        $data = AdminRole::query()
            ->filter($request->all())
            ->with('permissions:id,name')
            ->paginate();

        return $this->response->success(AdminRoleResource::collection($data));
    }

    public function create()
    {
        $data = AdminPermission::select('id', 'name')->get();

        return $this->response->success($data);
    }

    public function store(AdminRoleRequest $request)
    {
        $adminRole = AdminRole::create($request->validated());

        $adminRole->syncRoleAndPermission();

        return $this->response->created();
    }

    public function update(AdminRole $adminRole, AdminRoleRequest $request)
    {
        $adminRole->update($request->validated());

        $adminRole->syncRoleAndPermission();

        return $this->response->created();
    }

    public function destroy(AdminRole $adminRole)
    {
        if ($adminRole->id === 1) {
            $this->response->errorForbidden('超级管理员禁止删除！');
        }

        $adminRole->permissions()->detach();
        $adminRole->delete();

        return $this->response->noContent();
    }
}
