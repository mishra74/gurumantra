<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZoomWebhookController;

Route::post('/zoom/webhook',[ZoomWebhookController::class,'handle']);