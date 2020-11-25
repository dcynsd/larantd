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
            ->paginate();

        return $this->response()->success(AdminPermissionResource::collection($data));
    }

    public function store(AdminPermissionRequest $request)
    {
        AdminPermission::create($request->validated());

        return $this->response()->created();
    }

    public function update(AdminPermission $adminPermission, AdminPermissionRequest $request)
    {
        $adminPermission->update($request->validated());

        return $this->response()->created();
    }

    public function destroy(AdminPermission $adminPermission)
    {
        $adminPermission->delete();

        return $this->response()->noContent();
    }
}
