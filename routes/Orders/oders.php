<?php

use App\Http\Controllers\Orders\OrdersController;

Route::apiResource('organizations.orders', OrdersController::class);
