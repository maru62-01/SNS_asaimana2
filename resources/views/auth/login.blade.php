@extends('layouts.logout')

@section('content')
    <!-- 適切なURLを入力してください -->
    {!! Form::open(['url' => '/login']) !!}


    <div>
        <p>AtlasSNSへようこそ</p>

        {{ Form::label('e-mail') }}
        {{ Form::text('mail', null, ['class' => 'input']) }}
        {{ Form::label('password') }}
        {{ Form::password('password', ['class' => 'input']) }}

        {{ Form::submit('ログイン') }}

        <p><a href="/register">新規ユーザーの方はこちら</a></p>

        {!! Form::close() !!}
    </div>
@endsection
