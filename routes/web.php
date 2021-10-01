<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\manifestController;
use App\Http\Controllers\xmlController;


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



Route::post('/adminlogin', [loginController::class,'Adminlogin']);
Route::post('/fileuploads', [loginController::class,'FileUploads']);
Route::post('/logout', [loginController::class,'logout']);
Route::post('/manfileuploads', [manifestController::class,'manfileuploads']);
Route::post('/addterm', [loginController::class,'addterm']);
Route::post('/updpass', [loginController::class,'updpass']);
Route::post('/updpass2', [loginController::class,'updpass2']);
Route::get('/changepwd', [loginController::class,'chanpass']);
Route::get('/cp', [loginController::class,'cp']);
Route::post('/adduse', [loginController::class,'adduse']);
Route::get('/uploadpage', [loginController::class,'uploadpage']);
Route::get('/uploadpageuser', [loginController::class,'uploadpageuser']);
Route::get('/uploadmanifest', [manifestController::class,'uploadmanifest']);
Route::get('/uploadmanifestuser', [manifestController::class,'uploadmanifestuser']);
Route::get('/addterminal', [loginController::class,'addterminal']);
Route::get('/adduser', [loginController::class,'adduser']);
Route::get('/dashboard', [loginController::class,'dashboardpg']);
Route::get('/dashboarduser', [loginController::class,'dashboardpguser']);
Route::get('/viewxmll/{id}', [loginController::class,'viewxml']);
Route::get('/Exportxmls/{id}', [loginController::class,'Exportxml']);
Route::post('/createxmls', [xmlController::class,'createxml']);
Route::get('/delterm/{id}', [xmlController::class,'delterm']);
