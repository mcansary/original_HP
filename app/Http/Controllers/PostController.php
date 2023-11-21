<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;

class PostController extends Controller
{
    //
    public function __construct( Entry $entry )
    {
        $this->entry = $entry;
    }
}

 /**
     * 記事の一覧取得
     * 
     * @return view
     */
    public function index()
    {
        // 記事の取得
        $entries = $this->entry->orderBy('created_at', 'desc')->paginate(5);

        // viewに渡す値
        $params = [
            "entries" => $entries,
        ];

        return view('admin.post.index', $params);
    }

    /**
     * 記事の新規画面
     * 
     * @return view
     */
    public function add()
    {
        return view('admin.post.input');
    }

    /**
     * 記事の投稿（POST）
     *
     * @param Illuminate\Http\Request $request
     * @return redirect
     */
    public function addPost(Request $request)
    {
        // フォームの入力内容を全て取得
        $entries = $request->all();

        // DBに格納する値（記事）
        $entry = [
            'title' => $entries['title'],
            'content' => $entries['content'],
        ];

        // 記事をDBに格納
        $this->entry->fill($entry)->save();

        return redirect( route('admin.post.index') );
    }

    /**
     * 記事の編集画面
     * 
     * @param Illuminate\Http\Request $request
     * @return view
     */
    public function edit(Request $request)
    {
        // 記事IDを取得
        $post_id = $request->post_id;
        $request->merge( ['id' => $post_id] );

        // 記事を取得
        $entry = $this->entry->find($post_id);

        $params = [
            'entry' => $entry,
            'request' => $request,
        ];

        return view('admin.post.input', $params);
    }

    /**
     * 記事の更新（POST）
     * 
     * @param Illuminate\Http\Request $request
     * @return redirect
     */
    public function editPost(Request $request)
    {
        // 記事IDを取得
        $post_id = $request->post_id;

        // フォームの入力内容を全て取得
        $entries = $request->all();

        // DBを更新（記事）
        $entry = $this->entry->find( $entries['post_id'] );
        $entry->title = $request->title;
        $entry->content = $request->content;
        $entry->save();

        // メッセージ
        $message = '投稿が更新されました。';

        return redirect()->route('admin.post.edit', ['post_id' => $post_id])->with('update_message', $message);
    }

    /**
     * 記事の削除
     * 
     * @param
     * @return
     */
    public function deleteOne(Request $request)
    {
        if ( empty($request->post_id) ) {
            return redirect()->route('admin.post.index');
        }
        $this->entry->deleteOne($request->post_id);
        return redirect()->route('admin.post.index')->with('delete_message', '記事を１件削除しました。');