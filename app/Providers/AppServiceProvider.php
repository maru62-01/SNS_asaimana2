<?php
//アプリケーション全体で使う設定や共有データを管理する役割

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ← これを追加
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // 👇ビューで共通データを利用する設定を追加
    public function boot()
    {
        View::composer('layouts.login', function ($view) {
            if (auth()->check()) { // ログインしている場合のみデータを渡す
                $user = auth()->user();
                $followingCount = $user->following()->count();
                $followersCount = $user->followers()->count();

                $view->with([
                    'followingCount' => $followingCount,
                    'followersCount' => $followersCount,
                ]);
            }
        });
        //
    }
}
