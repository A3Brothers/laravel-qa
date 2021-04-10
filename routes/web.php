<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\VoteQuestionController;
use App\Http\Controllers\VoteAnswerController;


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

Route::get('/', [QuestionController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('questions', QuestionController::class)->except('show');

Route::resource('questions.answers', AnswerController::class)->middleware('auth')->only('store', 'edit', 'update', 'destroy');

Route::get('questions/{slug}', [QuestionController::class, 'show'])->name('questions.show');

Route::post('answers/{answer}', [AnswerController::class, 'accept'])->name('answers.accept');

Route::post('questions/{question}/favorites', [FavoriteController::class, 'store'])->name('questions.favorite');

Route::delete('questions/{question}/favorites', [FavoriteController::class, 'destroy'])->name('questions.unfavorite');

Route::post('questions/{question}/votes', VoteQuestionController::class)->name('question.vote');

Route::post('answers/{answer}/votes', VoteAnswerController::class)->name('answer.vote');



require __DIR__.'/auth.php';
