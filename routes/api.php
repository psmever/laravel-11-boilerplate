<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Syndication\V1\NewsenMsnController as NewsenMsnV1Controller;

/**
 * test
 */
Route::group(['prefix' => 'test', 'as' => 'test.'], function () {
    Route::controller(TestController::class)->group(function () {
        Route::post('/default', 'default')->name('test');
    });
});

/**
 * 신디케이션 api
 */
Route::middleware(['syndication'])->group(function () {
    Route::group(['prefix' => 'syndication', 'as' => 'syndication.'], function () {
        Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
            Route::controller(NewsenMsnV1Controller::class)->group(function () {
                Route::group(['prefix' => 'newsen-msn', 'as' => 'newsen-msn.'], function () {
                    Route::post('/create', 'create')->name('create'); // news-msn 등록
                });
            });
        });
    });
});
