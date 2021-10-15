<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;

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

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('exercises', ExerciseController::class);
    Route::get('my-exercises', [ExerciseController::class, 'showUserExercises'])->name('my-exercises');
    Route::post('rating', [RatingController::class, 'store'])->name('rating.store');
    Route::get('rating/{id}', [RatingController::class, 'index'])->name('rating.index');
});




