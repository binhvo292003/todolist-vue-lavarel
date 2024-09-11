<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('todos', [TodoController::class, 'index']);

Route::get('/', TodoController::class . '@index')->name('todos.index');
// returns the form for adding a todo
Route::get('/todos/create', TodoController::class . '@create')->name('todos.create');
// adds a todo to the database
Route::post('/todos', TodoController::class . '@store')->name('todos.store');
// returns a page that shows a full todo
Route::get('/todos/{todo}', TodoController::class . '@show')->name('todos.show');
// returns the form for editing a todo
Route::get('/todos/{todo}/edit', TodoController::class . '@edit')->name('todos.edit');
// updates a todo
Route::put('/todos/{todo}', TodoController::class . '@update')->name('todos.update');
// deletes a todo
Route::delete('/todos/{todo}', TodoController::class . '@destroy')->name('todos.destroy');
Route::delete('/todos', [TodoController::class, 'destroyAll']);
