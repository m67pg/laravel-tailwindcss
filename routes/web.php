<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

// プロジェクト
Route::get('/', [App\Http\Controllers\ProjectController::class, 'index'])
     ->name('/')
     ->middleware(['auth']);
Route::resource('project', ProjectController::class)
     ->except(['destroy'])
     ->middleware(['auth']);
// プロジェクト詳細
Route::resource('project.project_detail', ProjectDetailController::class, ['names' => 'project_detail'])
     ->parameters(['project' => 'project_id', 'project_detail' => 'id'])
     ->except(['show', 'destroy'])
     ->middleware(['auth']);
// 発注者
Route::resource('orderer', OrdererController::class)
     ->except(['show', 'destroy'])
     ->middleware(['auth']);
// クラウドソーシング
Route::resource('crowd_sourcing', CrowdSourcingController::class)
     ->except(['show', 'destroy'])
     ->middleware(['auth']);
// 進捗
Route::resource('progress', ProgressController::class)
     ->except(['show', 'destroy'])
     ->middleware(['auth']);

require __DIR__.'/auth.php';
