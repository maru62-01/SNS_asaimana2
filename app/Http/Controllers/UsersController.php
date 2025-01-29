<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User; //User クラスをインポート
use Illuminate\Support\Facades\Validator;
use App\Models\Post;


// Authファサードをインポート

class UsersController extends Controller
{

    // ユーザープロフィールページを表示
    public function profile($id)
    // $id　リクエスト時に渡される「ユーザーID」
    {
        // ユーザーの投稿を新しい順に表示
        $user = User::findOrFail($id); // ユーザーを取得
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        // 'desc' は「降順」 order・行の並べ替え
        // プロフィールビューを返す
        return view('users.profile', [
            'user' => $user,
            'posts' => $posts,
        ]);
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

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 記述方法：Validator::make('値の配列', '検証ルールの配列');
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users',
            'newPassword' => 'required|string|min:8|max:20|regex:/^[a-zA-Z0-9]+$/',
            'password-confirm' => 'required|string|same:newPassword',
            // same:newPassword=newPasswordと一致しているか確認
            'bio' => 'string|max:150',
            'IconImage' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
            // required＝必須　string＝文字列

        ]);

        return view('users.editprofile');
    }
}
