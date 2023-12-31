<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseImageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('courses', CourseController::class)->except(['destroy']);
Route::apiResource('chapters', ChapterController::class);
Route::apiResource('lessons', LessonController::class);
Route::apiResource('course-images', CourseImageController::class)->only(['store', 'destroy']);
Route::apiResource('my-courses', MyCourseController::class)->only(['index', 'store']);
Route::apiResource('reviews', ReviewController::class)->except(['index']);
