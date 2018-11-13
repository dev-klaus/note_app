<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get	("/notes", "NotesAppController@notes");
Route::post	("/add/background", "NotesAppController@addBackground");
Route::post	("/add/note", "NotesAppController@addNote");
Route::post	("/edit/note/{id}", "NotesAppController@editNote");
Route::delete	("/delete/note/{id}", "NotesAppController@deleteNote");
