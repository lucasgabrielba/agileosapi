<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::prefix('auth')->group(base_path('routes/auth.php'));

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show'])
    ->middleware('web');

Route::middleware('auth:sanctum')
    ->group(function () {

        //Organizations Domain
        require base_path('routes/Organizations/organizations.php');
        require base_path('routes/Organizations/users.php');

        //Orders Domain
        require base_path('routes/Orders/orders.php');
        require base_path('routes/Orders/clients.php');
        require base_path('routes/Orders/items.php');

        // require base_path('routes/Shared/uploads.php');

        // Route::prefix('admin')
        //     ->middleware('is.super.admin')
        //     ->group(base_path('routes/Admin/admin.php'));
    });
