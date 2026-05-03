<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LaihaController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\SectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth
Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);
Route::delete("logout",[AuthController::class,"logout"])->middleware("auth:sanctum");

// مسارات عامة - للعرض فقط (للطلاب والزوار)
Route::apiResource('sections', SectionController::class)->only(['index', 'show']);
Route::apiResource('laihas', LaihaController::class)->only(['index', 'show']);
Route::apiResource('levels', LevelController::class)->only(['index', 'show']);
Route::apiResource('courses', CourseController::class)->only(['index', 'show']);

// مسارات محمية - للتعديل والإضافة والحذف (للأدمن فقط)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('courses/import', [CourseController::class, 'importExcel']);
    Route::apiResource('sections', SectionController::class)->except(['index', 'show']);
    Route::apiResource('laihas', LaihaController::class)->except(['index', 'show']);
    Route::apiResource('levels', LevelController::class)->except(['index', 'show']);
    Route::apiResource('courses', CourseController::class)->except(['index', 'show']);
});
