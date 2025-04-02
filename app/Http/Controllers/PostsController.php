<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    //
    public function index()
    {
        // Postテーブルに関係あるuserデータを取得　作成日時の降順
        $list = Post::with('user')->orderBy('created_at', 'desc')->get();
        // // bladeヘ返す際にデータを送る
        return view('posts.index', ['list' => $list]);



        // return view('posts.index');
        //  ↑posts.index'を開いてください
    }

    //↓投稿処理 ＣREATEの実装
    public function postCreate(Request $request)
    {

        $name = $request->input('coment'); //input=textarea name="coment"
        $id = auth()->id(); //user情報を取得する

        Post::create([
            'post' => $name, //post=テーブル名
            'user_id' => $id,
        ]);
        return back();
    }

    // 投稿更新の処理・実装
    public function
    postUpdate(Request $request)
    {
        // Requestとは、bladeファイルに情報をもらうように頼んでいる
        //↓下の46、47行目で、postカラムとidカラムの情報を取得
        $up_post = $request->input('post');
        //'post'=teatreaのname
        $id = $request->input('post_id');
        //'post_id'はinoutのnameのname

        Post::where('id', $id)->update([
            'post' => $up_post,
        ]);
        // データベースのidカラムと、＄idか一致する('id', $id)
        // 'post'を$up_postにアップデート

        return back();
    }

    //投稿の削除処理
    public function
    postDelete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top'); //削除が完了したら、topページに戻る
    }
}
