<?php

use App\Http\Controllers\Orders\ItemsController;

Route::get('organizations/{organizationId}/items', [ItemsController::class, 'index']);
Route::post('organizations/{organizationId}/clients/{clientId}/items', [ItemsController::class, 'store']);
Route::get('organizations/{organizationId}/items/{itemId}', [ItemsController::class, 'show']);
Route::put('organizations/{organizationId}/items/{itemId}', [ItemsController::class, 'update']);
Route::delete('organizations/{organizationId}/items/{itemId}', [ItemsController::class, 'destroy']);
