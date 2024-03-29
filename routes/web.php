<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



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


Route::get('/', [TodoController::class,"index"]);

Route::post("/todo/create",[TodoController::class,"create"]);
Route::post("/todo/update",[TodoController::class,"update"]);
Route::post("/todo/delete",[TodoController::class,"delete"]);
Route::get("/todo/find",[TodoController::class,"find"]);
Route::get("/todo/search",[TodoController::class,"search"]);
Route::post("/todo/find/update",[TodoController::class,"findUpdate"]);
Route::post("/todo/find/delete",[TodoController::class,"findDelete"]);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


/*27行目、postをgetに変更*/
