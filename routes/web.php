<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\StudyController;

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
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/game/{game}', [GameController::class, 'show'])->name('games.show');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');

    //Favorites
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/favorite/{favorite}', [FavoriteController::class, 'show'])->name('favorites.show');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    //Studies
    Route::resource('studies', StudyController::class);

    Route::post('/add-users-to-study', [StudyController::class, 'addUserToStudy'])->name('add.users.to.study');

    //Chapters
    Route::post('/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::get('/get-chapter-pgn/{chapter}', [StudyController::class, 'getChapterPgn']);
    Route::get('/get-chapter-comments/{chapter}', [StudyController::class, 'getChapterComments']);

    //Comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php';
