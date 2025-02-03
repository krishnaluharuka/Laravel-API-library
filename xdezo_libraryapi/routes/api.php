<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('list',[AuthorController::class,'list']);

Route::post('addAuthor',[AuthorController::class,'addAuthor']);

Route::get('viewAuthor/{author_name}',[AuthorController::class,'viewAuthor']);

Route::put('updateAuthor/{id}',[AuthorController::class,'updateAuthor']);

Route::delete('deleteAuthor/{id}',[AuthorController::class,'deleteAuthor']);

Route::get('list-book',[BookController::class,'list']);

Route::post('addBook',[BookController::class,'addBook']);

Route::get('viewBook/{book_name}',[BookController::class,'viewBook']);

Route::put('updateBook/{id}',[BookController::class,'updateBook']);

Route::delete('deleteBook/{id}',[BookController::class,'deleteBook']);