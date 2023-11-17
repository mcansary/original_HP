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

use App\Http\Controllers\Admin\ProfileController;
Route::get('/top', [ProfileController::class, 'add'])->name('top');

use App\Http\Controllers\Admin\NewarticleController;
Route::get('/new', [NewArticleController::class, 'add'])->name('new');

use App\Http\Controllers\Admin\BlogController;
Route::get('/kaze', [BlogController::class, 'add'])->name('kaze');

use App\Http\Controllers\Admin\FormController;
Route::get('/form', [FormController::class, 'add'])->name('form');