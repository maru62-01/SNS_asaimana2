@extends('layouts.logout')

@section('content')
    <!-- 適切なURLを入力してください -->
    {!! Form::open(['url' => '/login']) !!}


    <div class="login-container">
        <p>AtlasSNSへようこそ</p>

        {{ Form::label('メールアドレス') }}
        {{ Form::text('mail', null, ['class' => 'input']) }}
        {{ Form::label('パスワード') }}
        {{ Form::password('password', ['class' => 'input']) }}

        <div class="login">
            <button type="submit" class="btn btn-danger btn-sm">ログイン</button>
        </div>

        <p class="new-user"><a href="/register">新規ユーザーの方はこちら</a></p>

        {!! Form::close() !!}
    </div>
@endsection
