  @extends('layouts.login')

  @section('content')
      <div class="update-form">
          {!! Form::open([
              'url' => route('profile.update'),
              'enctype' => 'multipart/form-data',
              'class' => 'update-inner',
          ]) !!} @csrf
          {{-- <p>ID: {{ Auth::user()->id }}</p> --}}

          <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
          <div class="icon-group">
              <img class="update-icon" src="{{ asset('storage/' . Auth::user()->images) }}">
          </div>
          <div class="list-group">
              <div class="form-group">
                  <p class="text-name">ユーザー名</p>
                  <input type="text" size="30" class="update-text" name="username"
                      value="{{ Auth::user()->username }}" />
                  {{-- Auth::user()現在ログイン中のユーザーのデータを取得して初期値として教示 --}}
              </div>
              <div class="form-group">
                  <p class="text-name">メールアドレス</p>
                  <input type="text" size="30" class="update-text" name="mail"
                      value="{{ Auth::user()->mail }}" />
              </div>
              <div class="form-group">
                  <p class="text-name">パスワード</p>
                  <input type="password" size="30" class="update-text" name="newPassword" value="" />
              </div>
              <div class="form-group">
                  <p class="text-name">パスワード確認</p>
                  <input type="password" size="30" class="update-text" name="password_confirm" value="" />
              </div>
              <div class="form-group">
                  <p class="text-name">自己紹介</p>
                  <input type="text" size="30" class="update-text" name="bio" value="{{ Auth::user()->bio }}" />
              </div>
              <div class="form-group">
                  <p class="text-name">アイコン画像</p>

                  <label for="form-image" class="image-file">
                      <span class="file-box">ファイルを選択</span>
                  </label>
                  <input type="file" size="30" id="form-image" name="IconImage"
                      value="{{ Auth::user()->images }}" />
              </div>
              <br />
              <button type="submit" class="btn btn-danger customs-class">更新</button>
              {!! Form::close() !!}
          </div>
      </div> <!-- ここで閉じタグを整えました -->
  @endsection
