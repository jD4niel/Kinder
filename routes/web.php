<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth','admin');
Route::get('/alumno', 'StudentController@index')->name('student.index')->middleware('auth','admin');
Route::delete('/alumno/borrar/{id}', 'StudentController@destroy')->name('student.delete')->middleware('auth','admin');
Route::put('/alumno/modificar/{id}', 'StudentController@update')->name('student.update')->middleware('auth','admin');
Route::get('/alumno/crear', function (){return view('AdminView/admin_create_student');})->name('student.crear')->middleware('auth','admin');
Route::post('/alumno/subirfoto','StudentController@uploadImg')->name('imagenes.up')->middleware('auth','editor_imagenes');