<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePassController;
use App\Http\Controllers\ClientController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'password', 'as' => 'changepass', 'middleware' => 'can:change-pass'], function () {
    Route::get('/change', [ChangePassController::class, 'showForm']);
    Route::post('/change', [ChangePassController::class, 'updatePass']);
});

Route::group(['prefix' => 'clients', 'middleware' => 'can:view-add-clients'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients');
    Route::post('/add', [ClientController::class, 'store']);
});