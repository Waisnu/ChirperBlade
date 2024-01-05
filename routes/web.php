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

Route::get('/', function ()  {
    return view('welcome');
})->name('home');

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






Route::middleware(['auth'])->group(function () {
    // Route for showing the profile edit page
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route for updating the profile information
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route for updating the timezone
    Route::post('/profile/update/timezone', [ProfileController::class, 'updateTimezone'])->name('profile.update.timezone');

    // Route for deleting the user profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





