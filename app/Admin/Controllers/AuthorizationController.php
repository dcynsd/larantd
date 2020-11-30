<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Resources\MeResource;
use Illuminate\Support\Facades\Auth;
use App\Admin\Requests\AuthorizationRequest;
use App\Admin\Services\AuthorizationService;

class AuthorizationController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        if (! $token = Auth::attempt($request->only(['username', 'password']))) {
            $this->response->errorBadRequest('用户名或密码错误');
        }

        return $this->response->success([
            'token' => $token,
        ]);
    }

    public function me()
    {
        return $this->response->success(new MeResource(Auth::user()));
    }

    public function menus(AuthorizationService $authorizationService)
    {
        return $this->response->success($authorizationService->getAuthMenus());
    }

    public function updateMe(Request $request)
    {
        if (! $params = $request->all()) {
            return $this->me();
        }

        $request->user()->update($params);

        return $this->me();
    }

    public function destroy()
    {
        Auth::logout();

        return $this->response->noContent();
    }
}
