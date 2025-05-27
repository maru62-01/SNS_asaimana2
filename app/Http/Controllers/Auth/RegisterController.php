<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;


class RegisterController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {

        if ($request->isMethod('post')) {
            // バリデーションルールの定義
            $validator = Validator::make($request->all(), [
                // 記述方法：Validator::make('値の配列', '検証ルールの配列');
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users,mail',
                // 登録アドレス不可
                'password' => 'required|string|min:8|max:20|regex:/^[a-zA-Z0-9]+$/|confirmed',
                'password_confirmation' => 'required|string|min:8|max:20|regex:/^[a-zA-Z0-9]+$/',
            ]);
            // バリデーションの失敗時の処理
            if ($validator->fails()) {
                return redirect('register') //リダイレクト
                    ->withErrors($validator)
                    ->withInput();
            }

            // バリデーション成功時の処理
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            // ユーザー名をセッションに保存
            Session::put('userName', $username); //'userName→キー

            //ユーザーの作成
            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('/added');
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
