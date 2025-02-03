<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('signup',[UserAuthController::class,'signup']);

Route::get('list',[AuthorController::class,'list']);

Route::group(['middleware'=>"auth:sanctum"],function(){

Route::post('addAuthor',[AuthorController::class,'addAuthor']);

Route::get('viewAuthor/{author_name}',[AuthorController::class,'viewAuthor']);

Route::put('updateAuthor/{id}',[AuthorController::class,'updateAuthor']);

Route::delete('deleteAuthor/{id}',[AuthorController::class,'deleteAuthor']);

Route::get('list-book',[BookController::class,'list']);

Route::post('addBook',[BookController::class,'addBook']);

Route::get('viewBook/{book_name}',[BookController::class,'viewBook']);

Route::put('updateBook/{id}',[BookController::class,'updateBook']);

Route::delete('deleteBook/{id}',[BookController::class,'deleteBook']);

});

Route::get('login',[UserAuthController::class,'login'])->name('login');