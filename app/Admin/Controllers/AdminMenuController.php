<?php

namespace App\Admin\Controllers;

use App\Admin\Models\AdminMenu;
use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminPermission;
use App\Admin\Requests\AdminMenuRequest;
use App\Admin\Services\AdminMenuService;

class AdminMenuController extends Controller
{
    protected $adminMenuService;

    public function __construct(AdminMenuService $adminMenuService)
    {
        $this->adminMenuService = $adminMenuService;
    }

    public function index()
    {
        return $this->response->success(['data' => $this->adminMenuService->getMenuTree()]);
    }

    public function create()
    {
        $tree = show_tree($this->adminMenuService->makeOptionsTree());
        array_unshift($tree, ['value' => 0, 'label' => '顶级菜单']);

        return $this->response()->success([
            'parent_tree' => $tree,
            'roles' => AdminRole::select('id', 'name')->get(),
            'permissions' => AdminPermission::select('id', 'name')->get(),
        ]);
    }

    public function store(AdminMenuRequest $request)
    {
        $adminMenu = AdminMenu::create($request->all());

        $adminMenu->syncRoleAndPermission();

        return $this->response->created();
    }

    public function update(AdminMenu $adminMenu, AdminMenuRequest $request)
    {
        $adminMenu->update($request->all());

        $adminMenu->syncRoleAndPermission();

        return $this->response->created();
    }

    public function destroy(AdminMenu $adminMenu)
    {
        $adminMenu->delete();

        return $this->response->noContent();
    }
}
