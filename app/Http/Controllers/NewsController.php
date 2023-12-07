<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $posts = News::orderByDesc('id')->limit(12)->get();

        // if (count($posts) > 0) {
        //     $headline = $posts->shift();
        // } else {
        //     $headline = null;
        // }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('news.index', [/*'headline' => $headline,*/ 'posts' => $posts]);
    }

    public function detail(Request $request)
    {
        if (empty($request->id)) {
            // 最新の情報を取得する→パラメータが渡されていないとき
            $detail = News::orderByDesc('id')->limit(1)->first();
        } else {
            // id=? の指定があるとき
            $detail = News::find($request->id);
            if (empty($detail)) {
                abort(404);
            }
        }
        return view('news.detail', ['detail' => $detail]);
    }
}
