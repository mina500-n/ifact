<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ScrapeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/news/submit',      [NewsController::class, 'create'])->name('news.create');
    Route::post('/news/submit',     [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{newsCheck}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/history',     [NewsController::class, 'history'])->name('news.history');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',              [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users',                  [AdminController::class, 'users'])->name('users');
    Route::get('/submissions',            [AdminController::class, 'submissions'])->name('submissions');
    Route::delete('/users/{user}',        [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/submissions/{newsCheck}', [AdminController::class, 'deleteSubmission'])->name('submissions.delete');
});
Route::post('/scrape-url', [ScrapeController::class, 'fetch'])
     ->name('scrape.fetch')
     ->middleware('auth');


require __DIR__.'/auth.php';
