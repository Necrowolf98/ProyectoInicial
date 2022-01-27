<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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
    return Inertia::render('welcome');
})->name('/');

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('user', UserController::class)->only(['index', 'store', 'update', 'destroy']);

require __DIR__.'/auth.php';