<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kaze;

class KazeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Kaze::all()->sortByDesc('updated_at');

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // kaze/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('kaze.index', ['headline' => $headline, 'posts' => $posts]);
    }

    public function detail(Request $request)
    {
        $detail = Kaze::latest()->first();
        return view('kaze.detail', ['detail' => $detail]);
    }
    
}
