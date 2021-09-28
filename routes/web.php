<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MenuController;

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

Route::any('/login', 'AuthController@login');
Route::get('/dashboard', 'AuthController@dashboard');
Route::get('/logout', 'AuthController@logout');

Route::get('/view', 'DataController@viewdata');
Route::any('/insert', 'DataController@insertdata');
Route::any('/update/{id}', 'DataController@updatedata');
Route::any('/delete/{id}', 'DataController@deletedata');

// Route::any('/insert', function() {
//  return view('insertdata');
// });

// Route::get('/view', function() {
//     return view('viewdata');
// });

Route::get('/', function() {
    return view('welcome');
});

// Priority No.3
Route::get('/menu', function() {
    return view('menudata');
});
// Priority No.2
Route::get('/menu', 'MenuController@index');     
// Priority No.1
Route::get('/menu', 'MenuController@show');

// Another Method TO call Controller As per Official Documentation 
// Route::get('/menu', [MenuController::class,'index']);
// Route::get('/menu', [MenuController::class,'show']);