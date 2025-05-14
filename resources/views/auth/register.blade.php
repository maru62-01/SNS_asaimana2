@extends('layouts.logout')

@section('content')
    <!-- 適切なURLを入力してください -->
    {!! Form::open(['url' => '/register']) !!}
    <!-- laravelでHTMLフォームを生成するためのコード

                                                        web.phpのregisterルーテイングにつなぐ-->
    <div class="login-container">
        <p>新規ユーザー登録</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- エラーメッセージを表示する -->


        {{ Form::label('ユーザー名') }}
        {{ Form::text('username', null, ['class' => 'input']) }}

        {{ Form::label('メールアドレス') }}
        {{ Form::text('mail', null, ['class' => 'input']) }}

        {{ Form::label('パスワード') }}
        {{ Form::password('password', null, ['class' => 'input']) }}

        {{ Form::label('パスワード確認') }}
        {{ Form::password('password_confirmation', null, ['class' => 'input']) }}

        <div class="login">
            <button type="submit" class="btn btn-danger">新規登録</button>
        </div>

        {{-- {{ Form::submit('登録') }} --}}

        <p class="new-user"><a href="/login">ログイン画面へ戻る</a></p>

        {!! Form::close() !!}
    </div>

@endsection
