<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::prefix('movies')->group(function () {
    // Route to get top 10 viewed movies
    Route::get('top-viewed', [MovieController::class, 'topViewedMovies']);

    // Route to get a listing of all movies
    Route::get('/', [MovieController::class, 'index']);

    // Route to store a newly created movie
    Route::post('/', [MovieController::class, 'store']);

    // Route to display a specific movie
    Route::get('{movie}', [MovieController::class, 'show']);

    // Route to update a specific movie
    Route::put('{movie}', [MovieController::class, 'update']);

    // Route to delete a specific movie
    Route::delete('{movie}', [MovieController::class, 'destroy']);
});
