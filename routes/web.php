<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

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

// route for /gate controller

Route::get('/gate', [AuthorizationController::class, 'index']) //'index' name of the CONTROLLER
    ->name('gate.index'); //name of the ROUTE



// route for dashboard controller
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::resource('chirps', ChirpController::class)
    //chirps.index = GET /chirps (index)
    //chirps.store = POST /chirps  (create)
    //chirps.edit = GET /chirps/{chirp}/edit (edit)
    //chirps.update = PUT /chirps/{chirp} (update)
    //chirps.destroy = DELETE /chirps/{chirp} (destroy)

    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
