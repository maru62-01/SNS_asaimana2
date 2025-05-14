@extends('layouts.logout')

@section('content')
    {!! Form::open(['url' => '/login']) !!}

    <div class="login-container">
        <p class="boldfont">{{ session('userName') }}さん</p>
        <!-- sessionキーを取り出す -->
        <p class="welcome">ようこそ!AtlasSNSへ</p>
        <p>ユーザー登録が完了しました。</p>
        <p class="go-welcome">早速ログインをしてみましょう。</p>

        {{-- onclick属性　クリックされたときに実行する動作を指定するための属性 --}}
        <button type="submit" class="btn btn-danger btn-sm">ログイン画面へ</button onclick="location.href='/login';">
        {!! Form::close() !!}

    </div>
@endsection
