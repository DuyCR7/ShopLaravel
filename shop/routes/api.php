<?php

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['web']], function () {

    Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
    Route::resource('login', LoginController::class);
    //routes here
    Route::middleware(['auth'])->group(function (){
        Route::get('/', [MainAdminController::class, 'index'])->name('admin');
        Route::get('main', [MainAdminController::class, 'index']);

        Route::resource('sliders', \App\Http\Controllers\api\SliderController::class);

        Route::post('upload/services', [UploadController::class, 'store']);
    });
});
