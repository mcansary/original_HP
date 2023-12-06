<?php

namespace App\Http\Controllers;
const NUM_PER_PAGE = 10;

use Illuminate\Http\Request;

use App\Models\Kaze;

class KazeController extends Controller
{
    public function index(Request $request)
    {
        // year=???? が指定されているとき
        // 条件指定を追加する
        $posts = Kaze::orderByDesc('id')->limit(12)->get();

        // if (count($posts) > 0) {
        //     $headline = $posts->shift();
        // } else {
        //     $headline = null;
        // }

        // kaze/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('kaze.index', [/*'headline' => $headline, */'posts' => $posts]);
    }

    public function detail(Request $request)
    {
        if (empty($request->id)) {
            // 最新の情報を取得する→パラメータが渡されていないとき
            $detail = Kaze::orderByDesc('id')->limit(1)->first();
        } else {
            // id=? の指定があるとき
            $detail = Kaze::find($request->id);
            if (empty($detail)) {
                abort(404);
            }
        }
        return view('kaze.detail', ['detail' => $detail]);
    }
    
    // public function list()
    // {
    //     $list = $this->article->getArticleList(self::NUM_PER_PAGE);
    //     return view('admin_kaze.list', compact('list'));
    // }
    
}
