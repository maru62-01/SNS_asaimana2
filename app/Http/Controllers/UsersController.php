<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User; //User クラスをインポート

// Authファサードをインポート

class UsersController extends Controller
{
    // ユーザープロフィールページを表示
    public function profile()
    {
        return view('users.profile');
    }

    // ユーザー検索ページを表示
    public function search(Request $request)
    {

        // 1つ目の処理
        // 検索フォームで入力された値を取得する
        $keyword = $request->input('keyword');

        // 2つ目の処理 曖昧な検索
        if (!empty($keyword)) {
            $users = User::where('username', 'like', '%' . $keyword . '%')->get();
        } else {
            $users = User::all();
        }

        // 検索結果と検索ワードをビューに表示
        return view(
            'users.search',
            ['users' => $users, 'keyword' => $keyword]
        );

        //return redirect＝ページを移動させる。
        // return viewは＝ページの内容を表示する。
    }

    //セッション
    //     public function added()
    // {
    //     $userName = Auth::user()->name; // ユーザー名を取得
    //     session(['userName' => $userName]); // セッションに保存



    //     return view('auth.added');
    // }
}
