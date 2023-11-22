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

use App\Http\Controllers\ProfileController;
Route::get('/top', [ProfileController::class, 'add'])->name('top');

use App\Http\Controllers\NewArticleController;
Route::get('/new', [NewArticleController::class, 'add'])->name('new');

use App\Http\Controllers\BlogController;
Route::get('/kaze', [BlogController::class, 'add'])->name('kaze');
// Route::controller(BlogController::class)->prefix('admin')->name('kaze')->middleware('auth')->group(function () {
//     Route::get('blog/insert', 'add')->name('kaze.add');
//     Route::post('blog/insert', 'create')->name('kaze.create');
// });

use App\Http\Controllers\FormController;
Route::get('/form', [FormController::class, 'add'])->name('form');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログイン後の処理
use App\Http\Controllers\Admin\AdminController;
Route::group(['middleware' => ['auth']], function () {
    // 記事の新規投稿画面
    Route::get('/admin/kaze/add', [AdminController::class, 'addKaze'])->name('admin.kaze.add');
});
// // カリキュラムだと、、、
// Route::controller(AdminController::class)->prefix('admin')->middleware('auth')->group(function() {
//     Route::get('kaze/add', 'addKaze')->name('admin.kaze.add');
// }

// Route::group(['middleware' => ['auth']], function () {
//
//             // 記事の新規投稿画面
//             Route::get('admin/post/add', [PostController::class, 'add'])->name('admin.post.add');
//             // 記事の投稿
//             Route::post('admin/post/add', [PostController::class, 'addPost']);
//             // 記事の編集画面
//             Route::get('admin/post/edit', [PostController::class, 'edit'])->name('admin.post.edit');
//             // 記事の更新
//             Route::post('admin/post/edit', [PostController::class, 'editPost']);
//             // 記事の削除
//             Route::get('admin/post/delete_one', [PostController::class, 'deleteOne'])->name('admin.post.delete');
//
// });
