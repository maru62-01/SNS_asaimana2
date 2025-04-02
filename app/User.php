<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    // フォローをした行った人用のリレーション
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    // フォローをされた人用のリレーション
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }


    // 「ログイン中のユーザーがフォローしているユーザー」を中間テーブルfollowsを使って取得
    // 多対多の関係
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }
    // followsの中のollowing_id', 'followed_id'

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }
    // フォローしているか
    public function isFollowing($user_id)
    {
        return (bool) $this->following()->where('followed_id', $user_id)->first();
    }








    //     // 上記メソッドを揃える
    //     return $this->following()->attach($user_id);
    // }

    // // フォローを解除する
    // public function unfollow($user_id)
    // {
    //     return $this->following()->detach($user_id);
    // }


    // // フォローされているか
    // public function isFollowed($user_id)
    // {
    //     return (bool) $this->followed()->where('following_id', $user_id)->first();
    // }
}
