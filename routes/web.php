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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;

Route::get('/', [ContactController::class, 'index']);
Route::get('/contacts/create', [ContactController::class, 'create'])->middleware('auth');
Route::get('/contacts/show/{id}', [ContactController::class, 'show']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->middleware('auth')->name('contacts.destroy');
Route::get('/contacts/edit/{id}', [ContactController::class, 'edit'])->middleware('auth');
Route::put('/contacts/update/{id}', [ContactController::class, 'update'])->middleware('auth');

Route::get('contacts/dashboard', [ContactController::class, 'dashboard'])->name('contacts.dashboard')->middleware('auth');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [ContactController::class, 'index']);

Route::get('/countries', [CountryController::class, 'getCountries']);

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
    Route::get('/show/{id}', [DashboardController::class, 'show'])->middleware('auth')->name('admin.show');
    Route::delete('/destroy/{id}', [DashboardController::class, 'destroy'])->middleware('auth')->name('admin.destroy');
    Route::get('/edit/{id}', [DashboardController::class, 'edit'])->middleware('auth');
    Route::put('/update/{id}', [DashboardController::class, 'update'])->middleware('auth');
    
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('auth.user')->middleware('auth');
    
});



