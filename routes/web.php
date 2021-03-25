<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('questions', QuestionController::class)->except('show');

Route::resource('questions.answers', AnswerController::class)->middleware('auth')->only('store', 'edit', 'update', 'destroy');


Route::get('questions/{slug}', [QuestionController::class, 'show'])->name('questions.show');


require __DIR__.'/auth.php';
