<?php

namespace App\Admin\Controllers;

use App\Admin\Resources\MeResource;
use Illuminate\Support\Facades\Auth;
use App\Admin\Requests\AuthorizationRequest;
use App\Admin\Services\AuthorizationService;

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

    public function menus(AuthorizationService $authorizationService)
    {
        return $this->response->success($authorizationService->getAuthMenus());
    }

    public function destroy()
    {
        Auth::logout();

        return response()->noContent();
    }
}
