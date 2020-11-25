<?php

namespace App\Admin\Controllers;

use App\Admin\Resources\MeResource;
use Illuminate\Support\Facades\Auth;
use App\Admin\Requests\AuthorizationRequest;

class AuthorizationController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        if (! $token = Auth::attempt($request->only(['username', 'password']))) {
            $this->response()->errorBadRequest('用户名或密码错误');
        }

        return response()->json([
            'token' => $token,
        ]);
    }

    public function me()
    {
        return $this->response()->success(new MeResource(Auth::user()));
    }

    public function menus()
    {
        $data = [
            [
                'id' => 1,
                'parentId' => 0,
                'name' => 'dashboard',
                'component' => 'RouteView',
                'path' => '/dashboard',
                'redirect' => '/dashboard/welcome',
                'meta' => [
                    'icon' => 'dashboard',
                    'title' => '仪表盘',
                    'show' => true,
                ],
            ],
            [
                'id' => 2,
                'parentId' => 1,
                'name' => 'welcome',
                'component' => 'Welcome',
                'path' => '/dashboard/welcome',
                'meta' => [
                    'icon' => '',
                    'title' => '欢迎',
                    'show' => true,
                ],
            ],
            [
                'id' => 3,
                'parentId' => 1,
                'name' => '404',
                'component' => '404',
                'path' => '/exception/404',
                'meta' => [
                    'icon' => '',
                    'title' => '404',
                    'show' => true,
                ],
            ],
            [
                'id' => 4,
                'parentId' => 1,
                'name' => 'PermissionList',
                'component' => 'PermissionList',
                'path' => '/setting/permissions/list',
                'meta' => [
                    'icon' => '',
                    'title' => '权限列表',
                    'show' => true,
                ],
            ],
        ];
        return $this->response->success($data);
    }

    public function destroy()
    {
        Auth::logout();

        return response()->noContent();
    }
}
