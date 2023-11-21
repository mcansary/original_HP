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
// ->middleware('auth');
use App\Http\Controllers\Admin\NewArticleController;
Route::get('/new', [NewArticleController::class, 'add'])->name('new');

use App\Http\Controllers\Admin\BlogController;
Route::get('/kaze', [BlogController::class, 'add'])->name('kaze');
// Route::controller(BlogController::class)->prefix('admin')->name('kaze')->middleware('auth')->group(function () {
//     Route::get('blog/insert', 'add')->name('kaze.add');
//     Route::post('blog/insert', 'create')->name('kaze.create');
// });

use App\Http\Controllers\Admin\FormController;
Route::get('/form', [FormController::class, 'add'])->name('form');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
