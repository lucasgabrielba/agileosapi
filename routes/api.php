<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(base_path('routes/auth.php'));

Route::middleware('auth:sanctum')
    ->group(function () {

        //Organizations Domain
        require base_path('routes/Organizations/organizations.php');
        require base_path('routes/Organizations/users.php');

        //Orders Domain
        require base_path('routes/Services/orders.php');
        require base_path('routes/Services/clients.php');
        require base_path('routes/Services/items.php');

        // require base_path('routes/Shared/uploads.php');

        // Route::prefix('admin')
        //     ->middleware('is.super.admin')
        //     ->group(base_path('routes/Admin/admin.php'));
    });
