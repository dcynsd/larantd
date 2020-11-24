<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\PageController;
use App\Admin\Controllers\AuthorizationController;

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
            'token.refresh',
        ])->group(function () {

            // 登录用户信息
            Route::get('authorizations/me', [AuthorizationController::class, 'me'])
                ->name('authorizations.me');
            // 退出登录
            Route::delete('authorizations', [AuthorizationController::class, 'destroy'])
                ->name('authorizations.destroy');

        });

    });
