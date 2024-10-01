<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/fileUpload', function () {
    return view('fileUpload');
});


Route::post('/fileUp', 'UploadController@fileUpload') ;
Route::get('/fileDownload/{tablePath}/{path}', 'downloadController@onDownload') ;
Route::get('/fileList', 'downloadController@onSelectFileList') ;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
