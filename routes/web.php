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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('home');
Route::get('/home/dataUpdate', 'HomeController@dataUpdate')->name('home.update');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth','admin');
/*Modulo Admin alumnos*/
Route::get('/alumno', 'StudentController@index')->name('student.index')->middleware('auth','admin');
Route::get('/alumno/missing', 'StudentController@studentMissing')->name('student.missing')->middleware('auth','admin');
Route::delete('/alumno/borrar/{id}', 'StudentController@destroy')->name('student.delete')->middleware('auth','admin');
Route::put('/alumno/modificar/{id}', 'StudentController@update')->name('student.update')->middleware('auth','admin');
Route::get('/alumno/crear', 'StudentController@createView')->name('student.crear')->middleware('auth','admin');
Route::post('/alumno/crear/guardar', 'StudentController@store')->name('student.create')->middleware('auth','admin');
Route::get('/alumno/crear/select', 'StudentController@fillSelect')->name('colony.select')->middleware('auth','admin');
Route::post('/alumno/subirfoto','StudentController@uploadImg')->name('imagenes.up')->middleware('auth','admin');
/*credencial*/
Route::get('/alumno/credencial','PdfController@index')->name('credential.pdf')->middleware('auth','admin');
/*codiog QR*/
Route::get('/alumno/crear/qr','StudentController@makeQR')->name('generate.qr')->middleware('auth','admin');
/*Modulo Admin tutores*/
Route::get('/tutores', 'TutorController@index')->name('tutor.index')->middleware('auth','admin');
Route::delete('/tutores/borrar/{id}', 'TutorController@destroy')->name('tutor.delete')->middleware('auth','admin');
Route::put('/tutores/modificar/{id}', 'TutorController@update')->name('tutor.update')->middleware('auth','admin');
/*Modulo vigilantes*/
Route::get('/registro','VigilantController@index')->name('registry.index')->middleware('auth','admin');
Route::post('/registro/alumno','VigilantController@dataRead')->name('registry.data')->middleware('auth','admin');
Route::post('/registro/entrada','VigilantController@store')->name('store.entry')->middleware('auth','admin');