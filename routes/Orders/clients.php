<?php

use App\Http\Controllers\Orders\ClientsController;

Route::apiResource('organizations.clients', ClientsController::class);
