<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Models\AdminPermission;
use App\Admin\Requests\AdminPermissionRequest;
use App\Admin\Resources\AdminPermissionResource;

class AdminPermissionController extends Controller
{
    public function index(Request $request)
    {
        $data = AdminPermission::query()
            ->filter($request->all())
            ->paginate($request->limit);

        return $this->response->success(AdminPermissionResource::collection($data));
    }

    public function store(AdminPermissionRequest $request)
    {
        AdminPermission::create($request->validated());

        return $this->response->created();
    }

    public function update(AdminPermission $adminPermission, AdminPermissionRequest $request)
    {
        $adminPermission->update($request->validated());

        return $this->response->created();
    }

    public function destroy(AdminPermission $adminPermission)
    {
        if ($adminPermission->id === 1) {
            $this->response->errorForbidden('禁止删除全部权限！');
        }

        $adminPermission->delete();

        return $this->response->noContent();
    }

    public function batchDestroy(Request $request)
    {
        if (! $ids = $request->input('ids', [])) {
            $this->response->errorBadRequest('请选择');
        }

        AdminPermission::query()->whereIn('id', $ids)->delete();

        return $this->response->noContent();
    }
}
