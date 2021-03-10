<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUsing;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListUsersController;
use App\Http\Controllers\PermitionController;
use App\Models\ListUsers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|php
*/
App::setLocale('cs');


Route::get('/credentials', function () {    return view('credentials');});



Route::middleware(['auth:sanctum', 'verified'])->get('/', [DashboardController::class,'show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [ListUsersController::class,'showAllUsers']);
Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users/{id:id}', [ListUsersController::class,'showUser']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_permitions'])->get('/permitions', [PermitionController::class,'showPermissions']);


//Kapitoly
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_image', [ContentController::class,'saveImage']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_chapter', [ChapterController::class,'addChapter']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->delete('/remove_chapter/{id:id}', [ChapterController::class,'removeChapter']);
Route::middleware(['auth:sanctum', 'verified'])->get('/status_chapter/{id:id}', [ChapterController::class,'statusChapter']);
Route::middleware(['auth:sanctum', 'verified'])->get('/rule_chapter/{id:id}', [ChapterController::class,'ruleChapter']);

//Uživatelé
Route::post('/users/{id:id}/saveUserData', [ListUsersController::class,'saveUserData']);
Route::get('/users/usersSort/{sort?}', [ListUsersController::class,'usersSort']);
Route::get('/users/usersFind/{find?}', [ListUsersController::class,'usersFind']);
Route::get('/getUserNames', [ListUsersController::class,'getUserNames']);
Route::middleware(['auth:sanctum', 'verified'])->get('/status_user/{id:id}', [ListUsersController::class,'statusUser']);


//Oprávnění
Route::post('/addPermition', [PermitionController::class,'addPermition']);
Route::post('/savePermitionData', [PermitionController::class,'savePermitionData']);
Route::delete('/removePermition/{id:id}', [PermitionController::class,'removePermition']);
