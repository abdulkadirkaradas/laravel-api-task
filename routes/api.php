<?php

use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/authorize", [AuthorizationsController::class, "authorizing"]);

Route::group(["namespace" => "Api", "middleware" => ["apimw"]], function() {
    Route::get("/read", [BooksController::class, "read"]);
    Route::put("/update", [BooksController::class, "update"]);
    Route::delete("/delete", [BooksController::class, "delete"]);
});
