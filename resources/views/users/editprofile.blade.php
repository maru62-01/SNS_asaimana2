  @extends('layouts.login')

  @section('content')
      <div class="update-form">
          {!! Form::open(['url' => '/profile/update', 'method' => 'post']) !!}
          {{-- <p>ID: {{ Auth::user()->id }}</p> --}}
          <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
          <p>ユーザー名</p>
          <input type="text" name="name" value="{{ Auth::user()->username }}" />
          {{-- Auth::user()現在ログイン中のユーザーのデータを取得して初期値として教示 --}}
          <p>メールアドレス</p>
          <input type="text" name="mail" value="{{ Auth::user()->mail }}" />
          <p>パスワード</p>
          <input type="password" name="password" placeholder="新しいパスワードを入力してください" />
          <p>パスワード確認</p>
          <input type="password" name="password_confirmation" value="" />
          <p>自己紹介</p>
          <input type="text" name="bio" value="{{ Auth::user()->bio }}" />
          <p>アイコン画像</p>
          <input type="file" name="IconImage" value="" />
          <br />
          <input type="submit" value="更新" /> {{ Form::token() }}
          {!! Form::close() !!}
      </div>
  @endsection
