<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kaze;

class AdminController extends Controller
{
    //
    public function addKaze() {
        return view('admin.kaze.add');
    }
    
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Kaze::$rules);

        $kaze = new Kaze;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $kaze->image_path = basename($path);
        } else {
            $kaze->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $kaze->fill($form);
        $kaze->save();
        
        return redirect('admin/kaze/add');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Kaze::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Kaze::all();
        }
        return view('admin.kaze.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $kaze = Kaze::find($request->id);
        if (empty($kaze)) {
            abort(404);
        }
        return view('admin.kaze.edit', ['kaze_form' => $kaze]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Kaze::$rules);
        // News Modelからデータを取得する
        $kaze = Kaze::find($request->id);
        // 送信されてきたフォームデータを格納する
        $kaze_form = $request->all();
        
        if ($request->remove == 'true') {
            $kaze_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $kaze_form['image_path'] = basename($path);
        } else {
            $kaze_form['image_path'] = $kaze->image_path;
        }

        unset($kaze_form['image']);
        unset($kaze_form['remove']);
        unset($kaze_form['_token']);

        // 該当するデータを上書きして保存する
        $kaze->fill($kaze_form)->save();

        return redirect('admin/kaze/index');
    }
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $kaze = Kaze::find($request->id);

        // 削除する
        $kaze->delete();

        return redirect('admin/kaze/index');
    }
}
