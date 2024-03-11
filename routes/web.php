<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\StudyController;

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
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/analysis', function () {
    return view('analysis');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Games
    Route::get('/games', [GameController::class, 'index']);
    Route::get('/game/{game}', [GameController::class, 'show']);
    Route::post('/games', [GameController::class, 'store']);
    Route::delete('/games/{game}', [GameController::class, 'destroy']);

    //Favorites
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::get('/favorite/{favorite}', [FavoriteController::class, 'show']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy']);

    //Studies
    Route::get('/studies', [StudyController::class, 'index']);
    Route::get('/studies/create', [StudyController::class, 'create']);
    Route::get('/study/{study}', [StudyController::class, 'show']);
    Route::post('/studies', [StudyController::class, 'store']);

    //Chapters
    Route::post('/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::get('/get-chapter-pgn/{chapter}', [StudyController::class, 'getChapterPgn']);
    Route::get('/get-chapter-comments/{chapter}', [StudyController::class, 'getChapterComments']);

    //Comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php';
