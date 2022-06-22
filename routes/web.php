<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AttachmentsController;
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

Route::get('/', [ApplicationsController::class, 'create'])->name('applications.create');
Route::post('/applications', [ApplicationsController::class, 'store'])->name('applications.store');

Route::group(['middleware' => 'auth.basic'], function(){
    Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications.index');
    Route::get('/attachments/serve/{id}', [AttachmentsController::class, 'serve'])->name('attachments.serve');
});

