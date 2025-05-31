@extends('layouts.logout')

@section('content')
    <!-- 適切なURLを入力してください -->
    {!! Form::open(['url' => '/register']) !!}
    <!-- laravelでHTMLフォームを生成するためのコード web.phpのregisterルーテイングにつなぐ-->
    <div class="login-container">
        <p>新規ユーザー登録</p>


        {{-- ユーザー名 --}}
        {{ Form::label('ユーザー名') }}
        {{ Form::text('username', null, ['class' => 'input']) }}
        @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
        @endif
        {{-- if文　エラー文の表示 --}}

        {{-- メールアドレス --}}
        {{ Form::label('メールアドレス') }}
        {{ Form::text('mail', null, ['class' => 'input']) }}
        @if ($errors->has('mail'))
            <span class="text-danger">{{ $errors->first('mail') }}</span>
        @endif

        {{-- パスワード --}}
        {{ Form::label('パスワード') }}
        {{ Form::password('password', ['class' => 'input']) }}
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif

        {{-- パスワード確認 --}}
        {{ Form::label('パスワード確認') }}
        {{ Form::password('password_confirmation', ['class' => 'input']) }}
        @if ($errors->has('password_confirmation'))
            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
        @endif

        <div class="login">
            <button type="submit" class="btn btn-danger">新規登録</button>
        </div>

        <p class="new-user"><a href="/login">ログイン画面へ戻る</a></p>

        {!! Form::close() !!}
    </div>
@endsection
