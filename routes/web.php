<?php

use App\Http\Controllers\BooksController;
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



Route::get('/new-user-error', function () {    return view('new-user-error');});



Route::middleware(['auth:sanctum', 'verified'])->get('/', [DashboardController::class,'show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chapters/{id:id}', [ChapterController::class,'showChapters']);

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [ListUsersController::class,'showAllUsers']);
Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users/{id:id}', [ListUsersController::class,'showUser']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_permitions'])->get('/permitions', [PermitionController::class,'showPermissions']);


Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_read'])->get('/chapter/{id:id}', [ChapterController::class,'showChapter']);
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_read,edit_content'])->get('/chapter/{id:id}/edit', [ChapterController::class,'showChapterEdit']);

//Kontent
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_image', [ContentController::class,'saveImage']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_image', [ContentController::class,'addImage']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_file', [ContentController::class,'saveFile']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_file', [ContentController::class,'addFile']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_name', [ContentController::class,'saveName']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_description', [ContentController::class,'saveDescription']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_column', [ContentController::class,'saveColumn']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_finished', [ContentController::class,'saveFinished']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->delete('/remove/{table_name?}/{id:id}', [ContentController::class,'removeElement']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->delete('/remove_image/{id:id}', [ContentController::class,'removeImage']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->delete('/remove_file/{id:id}', [ContentController::class,'removeFile']);

Route::middleware(['auth:sanctum', 'verified', ])->post('/finish_element', [ContentController::class,'finishElement']);

Route::middleware(['auth:sanctum', 'verified'])->get('/image_selector', [ContentController::class,'getImagesSelector']);
Route::middleware(['auth:sanctum', 'verified'])->get('/image_selector_gallery', [ContentController::class,'getImagesSelectorGallery']);

Route::middleware(['auth:sanctum', 'verified'])->get('/file_selector', [ContentController::class,'getFileSelector']);
Route::middleware(['auth:sanctum', 'verified'])->get('/file_selector_gallery', [ContentController::class,'getFileSelectorGallery']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_element', [ContentController::class,'addElement']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/get_element_selector', [ContentController::class,'getElementsSelector']);


Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/move', [ContentController::class,'move']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->get('/edit_setting/{table_name?}/{id:id}', [ContentController::class,'editSetting']);
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/save_setting/{table_name?}/{id:id}', [ContentController::class,'saveSetting']);

//Učebnice
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_book', [BooksController::class,'addBook']);
Route::middleware(['auth:sanctum', 'verified'])->get('/get_book_status/{id:id}', [BooksController::class,'getStatus']);

//Kapitoly
Route::middleware(['auth:sanctum', 'verified', 'permition:edit_content'])->post('/add_chapter', [ChapterController::class,'addChapter']);
Route::middleware(['auth:sanctum', 'verified'])->get('/get_chapter_status/{id:id}', [ChapterController::class,'getStatus']);


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
Route::middleware(['auth:sanctum', 'verified'])->get('/get_user_status/{id:id}', [ListUsersController::class,'getStatus']);


//Oprávnění
Route::post('/addPermition', [PermitionController::class,'addPermition']);
Route::post('/savePermitionData', [PermitionController::class,'savePermitionData']);
Route::delete('/removePermition/{id:id}', [PermitionController::class,'removePermition']);
