<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\apiController;
use App\Http\Controllers\friendController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\projectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('friends',           [friendController::class, 'index'])->name('friends');

Route::get('users',             [adminController::class, 'users_api'])->name('users');
Route::get('projects_api',      [adminController::class, 'projects_api'])->name('projects_api');
Route::get('comments_api',      [adminController::class, 'comments_api'])->name('project.comments_api');

Route::get('belongsto_api/{user_id}',      [adminController::class, 'belongsto_api'])->name('project.belongsto_api');

Route::get('all_projects',      [projectController::class, 'all_projects']);

Route::get('notice/{user_id}',  [apiController::class, 'notice']);
Route::get('countrys',          [apiController::class, 'countrys']);
