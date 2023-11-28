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
}
