<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\PageController;
use App\Admin\Controllers\AdminRoleController;
use App\Admin\Controllers\AuthorizationController;
use App\Admin\Controllers\AdminPermissionController;

Route::get('/admin/{path?}', [PageController::class, 'root'])
    ->where('path', '.*')
    ->name('admin.pages.root');

Route::prefix('admin-api')
    ->name('admin.')
    ->group(function () {

        // 登录
        Route::post('authorizations', [AuthorizationController::class, 'store'])
            ->name('authorizations.store');

        Route::middleware([
            'auth:admin',
            'admin.permission',
            'token.refresh',
        ])->group(function () {

            // 登录用户信息
            Route::get('authorizations/me', [AuthorizationController::class, 'me'])
                ->name('authorizations.me');
            // 更新用户信息
            Route::put('authorizations/me', [AuthorizationController::class, 'updateMe'])
                ->name('authorizations.me.update');
            // 菜单
            Route::get('authorizations/menus', [AuthorizationController::class, 'menus'])
                ->name('authorizations.menus');
            // 退出登录
            Route::delete('authorizations', [AuthorizationController::class, 'destroy'])
                ->name('authorizations.destroy');
            // 文件系统
            Route::resource('file-systems', 'FileSystemController')
                ->only(['index', 'store']);

            // 权限批量删除
            Route::delete('admin-permissions/batch', [AdminPermissionController::class, 'batchDestroy'])
                ->name('admin-permissions.batch.destroy');
            // 角色批量删除
            Route::delete('admin-roles/batch', [AdminRoleController::class, 'batchDestroy'])
                ->name('admin-roles.batch.destroy');

            Route::resources([
                'admin-permissions' => 'AdminPermissionController',
                'admin-roles' => 'AdminRoleController',
                'admin-menus' => 'AdminMenuController',
                'admin-users' => 'AdminUserController',
            ]);

        });

    });
