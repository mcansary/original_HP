<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kaze;

class KazeController extends Controller
{
    public function index(Request $request)
    {
        // year=???? が指定されているとき
        if (!empty($request->year)) {
            // 条件指定を追加する
            $posts = Kaze::where('year', $request->year)->orderByRaw('CAST(month as SIGNED) DESC')->get();
            if ($posts->isEmpty()) {
                // もし空っぽだったら、最新の１２件を取り直す
                $posts = Kaze::orderByDesc('year')->orderByRaw('CAST(month as SIGNED) DESC')->limit(12)->get();
            }
        } else {
            // year=???? の指定がなかったとき、最新の１２件を取得する
            $posts = Kaze::orderByDesc('year')->orderByRaw('CAST(month as SIGNED) DESC')->limit(12)->get();
        }

        if ($posts->isEmpty()) {
            // やっぱり空っぽだったらエラー画面
            abort(404);
        }

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
            $detail =Kaze::orderByDesc('year')->orderByRaw('CAST(month as SIGNED) DESC')->limit(1)->first();
        } else {
            // id=? の指定があるとき
            $detail = Kaze::find($request->id);
            if (empty($detail)) {
                abort(404);
            }
        }
        return view('kaze.detail', ['detail' => $detail]);
    }
    
    public function list()
    {
        $kaze_list = Kaze::select('year')->groupBy('year')->orderByDesc('year')->get();

        return view('kaze.list', ['kaze_list' => $kaze_list]);
    }
    
    // public function list()
    // {
    //     $list = $this->article->getArticleList(self::NUM_PER_PAGE);
    //     return view('admin_kaze.list', compact('list'));
    // }
    
}
