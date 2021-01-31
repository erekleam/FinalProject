<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\LibraryController;

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


Route::get('/', [HomeController::class, 'home']);
Route::get('/books', [HomeController::class, 'home']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/about-us', [HomeController::class, 'about']);


Route::get('/cms', function() {
    return Redirect("/login");
});
Route::middleware(['auth:sanctum', 'verified'])->prefix("/cms/")->group(function () {
    Route::get('/dashboard', function () {
        return view("dashboard");
    });

    Route::get('/books', [BooksController::class, 'getAll']);
    Route::get('/books/create', [BooksController::class, 'createBook']);
    Route::get('/books/delete/{id}', [BooksController::class, 'deleteRecordByRecordId']);
    Route::get('/books/exportData', [BooksController::class, 'exportBooksToCsv']);
    Route::post('/books/create', [BooksController::class, 'createBookRecord']);


    Route::get('/authors', [AuthorsController::class, 'getAll']);
    Route::get('/authors/create', [AuthorsController::class, 'createAuthor']);
    Route::get('/authors/delete/{id}', [AuthorsController::class, 'deleteRecordByRecordId']);
    Route::post('/authors/create', [AuthorsController::class, 'createAuthorRecord']);


    Route::get('/libraries', [LibraryController::class, 'getAll']);
    Route::get('/libraries/create', [LibraryController::class, 'createLibrary']);
    Route::get('/libraries/delete/{id}', [LibraryController::class, 'deleteRecordByRecordId']);
    Route::post('/libraries/create', [LibraryController::class, 'createLibraryRecord']);

});

