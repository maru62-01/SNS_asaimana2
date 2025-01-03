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


        // 検索結果と検索ワードをビューに表示
        return view(
            'users.search',
            ['users' => $users, 'keyword' => $keyword, 'userToUnfollow' => $userToUnfollow] // ここに$userToUnfollowを追加
        );

        //return redirect＝ページを移動させる。
        // return viewは＝ページの内容を表示する。
    }

    // フォロー解除
    public function unfollow($id)
    {

        $user = auth()->user();
        $userToUnfollow = User::findOrFail($id);
        //指定したidが見つからなかったらエラーを返す

        // フォロー関係を削除
        if ($user->following()->where('followed_id', $userToUnfollow->id)->exists()) {
            $user->following()->detach($userToUnfollow->id);
        }

        return back();
    }

    // フォローする
    public function follow($id)
    {
        $user = auth()->user();
        $userToFollow = User::findOrFail($id);

        // フォロー関係を作成
        if (!$user->following()->where('followed_id', $userToFollow->id)->exists()) {
            $user->following()->attach($userToFollow->id);
        }
        return back();
    }

    public function image(Request $request, User $user)
    {
        // バリデーション省略
        $originalImg = $request->user_image; // アップロードされた画像を取得

        if ($originalImg->isValid()) { // 画像が有効かどうかを確認
            $filePath = $originalImg->store('public'); // 画像を 'public' フォルダに保存
            $user->image = str_replace('public/', '', $filePath); // 保存したパスから 'public/' を取り除く
            $user->save(); // ユーザーの情報をデータベースに保存
            return redirect("/user/{$user->id}")->with('user', $user); // ユーザーのプロフィールページにリダイレクト
        }
    }
}
