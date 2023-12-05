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
// // カリキュラムだと、、、
Route::controller(AdminController::class)->prefix('admin')->middleware('auth')->group(function() {
    Route::get('kaze/add', 'addKaze')->name('admin.kaze.add');
    Route::post('kaze/add', 'create')->name('admin.kaze.create');
    Route::get('kaze/index', 'index')->name('admin.kaze.index');
    Route::get('kaze/edit', 'edit')->name('admin.kaze.edit');
    Route::post('kaze/edit', 'update')->name('admin.kaze.update');
    Route::get('kaze/delete', 'delete')->name('admin.kaze.delete');
});

use App\Http\Controllers\Admin\NewsController;
// // カリキュラムだと、、、
Route::controller(NewsController::class)->prefix('admin')->middleware('auth')->group(function() {
    Route::get('news/add', 'addnews')->name('admin.news.add');
    Route::post('news/add', 'create')->name('admin.news.create');
    Route::get('news/index', 'index')->name('admin.news.index');
    Route::get('news/edit', 'edit')->name('admin.news.edit');
    Route::post('news/edit', 'update')->name('admin.news.update');
    Route::get('news/delete', 'delete')->name('admin.news.delete');
});
// Route::group(['middleware' => ['auth']], function () {
//     // 記事の新規投稿画面
//     Route::get('/admin/kaze/add', [AdminController::class, 'addKaze'])->name('admin.kaze.add');
// });

// 11/29メンタリングで聞く（一般ユーザーが読むサイト作成のルーティング） 
use App\Http\Controllers\KazeController;
Route::get('/kaze/index', [KazeController::class, 'index'])->name('kaze.index');
Route::get('/kaze/detail', [KazeController::class, 'detail'])->name('kaze.detail');

use App\Http\Controllers\NewsController as PublicNewsController;
Route::get('/news/index', [PublicNewsController::class, 'index'])->name('news.index');
Route::get('/news/detail', [PublicNewsController::class, 'detail'])->name('news.detail');



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
