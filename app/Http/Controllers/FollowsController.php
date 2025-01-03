<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Follow; // クラスをインポート

use App\Post;

class FollowsController extends Controller
{

    public function followList()
    {
        // ログインユーザーがフォローしているユーザーを取得
        $follows = auth()->user()->follows()->get();

        // フォローしているユーザーのidを取得
        $following_id = auth()->user()->follows()->pluck('followed_id');
        // Postテーブルのレコードを取得
        $posts = Post::get();

        //フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('user_id', $following_id)->latest()->get();
        // latest　投稿を**最新順（降順）**に並べ替え
        // フォローしているユーザーが作成した投稿だけを対象に絞り込み

        return view('follows.followList', ['posts' => $posts, 'follows' => $follows]);
    }


    public function followerList()
    {
        // ログインユーザーをフォローしているユーザーを取得
        $followers = auth()->user()->followers()->get();

        // フォロワーのユーザーIDを取得
        $follower_ids = auth()->user()->followers()->pluck('following_id');

        // フォロワーの投稿を取得
        $posts = Post::whereIn('user_id', $follower_ids)
            ->latest() // 最新の投稿順に並べる
            ->get();

        // ビューにデータを渡す
        return view('follows.followerList', [
            'followers' => $followers,
            'posts' => $posts,
        ]);
    }
}
