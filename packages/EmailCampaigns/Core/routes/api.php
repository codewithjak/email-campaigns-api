<?php

use Illuminate\Support\Facades\Route;
use EmailCampaigns\Core\Http\Controllers\CampaignController;
use EmailCampaigns\Core\Http\Controllers\AudienceController;


Route::prefix('campaigns')->middleware([])->group(function () {
    Route::post('/', [CampaignController::class, 'store']);
});

Route::get('/audience/filter', [AudienceController::class, 'filter']);


Route::post('/campaigns/{campaign}/send', [CampaignController::class, 'sendToFilteredAudience']);

Route::middleware([])->get('test', function () {
    return response()->json(['message' => 'Test route works!']);
});
