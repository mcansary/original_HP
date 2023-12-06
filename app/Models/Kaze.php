<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaze extends Model
{
    use HasFactory;
    // 以下を追記
    protected $table = 'kaze';
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    // public function getKazeList($num_per_page = 10)
    // {
    //     // Eloquent モデルはクエリビルダとしても動作するので、orderBy メソッドも paginate メソッドも利用できる
    //     // paginate メソッドを使うと、ページネーションに必要な全件数の取得やオフセットの指定などは全部やってくれる
    //     return $this->orderBy('kaze_id', 'desc')->paginate($num_per_page);
    // }
}
