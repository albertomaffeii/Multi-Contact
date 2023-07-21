<?php

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

use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index']);
Route::get('/contacts/create', [ContactController::class, 'create'])->middleware('auth');
Route::get('/contacts/show/{id}', [ContactController::class, 'show']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->middleware('auth');
Route::get('/contacts/edit/{id}', [ContactController::class, 'edit'])->middleware('auth');
Route::put('/contacts/update/{id}', [ContactController::class, 'update'])->middleware('auth');

Route::get('/dashboard', [ContactController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
