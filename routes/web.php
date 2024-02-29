<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


 Route::get('dashboard',[DemoController::class,'dashboard'])->name('dashboard');
 Route::post('save-demo',[DemoController::class,'save_demo'])->name('save-demo');
Route::get('connection',[DemoController::class,'check_connection']);
