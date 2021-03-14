<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LockController;
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

Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_read'])->get('/chapter/{id:id}', [ChapterController::class,'showChapter']);


//Kontent
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_image', [ContentController::class,'saveImage']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_name', [ContentController::class,'saveName']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_description', [ContentController::class,'saveDescription']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_big_box', [ContentController::class,'addBigbox']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_middle_box', [ContentController::class,'addMiddlebox']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/move', [ContentController::class,'move']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->get('/edit_setting/{table_name?}/{id:id}', [ContentController::class,'editSetting']);

//Kapitoly
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_chapter', [ChapterController::class,'addChapter']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->delete('/remove_chapter/{id:id}', [ChapterController::class,'removeChapter']);
Route::middleware(['auth:sanctum', 'verified'])->get('/status_chapter/{id:id}', [ChapterController::class,'statusChapter']);


//Pravidla
Route::middleware(['auth:sanctum', 'verified'])->get('/rule_setting/{table_name?}/{id:id}', [LockController::class,'ruleSetting']);
Route::middleware(['auth:sanctum', 'verified'])->get('/check_lock/{table_name?}/{id:id}', [LockController::class,'checkLock']);
Route::middleware(['auth:sanctum', 'verified'])->post('/save_rule', [LockController::class,'saveRule']);
Route::middleware(['auth:sanctum', 'verified'])->post('/unlock', [LockController::class,'unlock']);

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
