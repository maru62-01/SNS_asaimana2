@extends('layouts.login')

@section('content')
    {{-- ユーザー名検索 --}}
    <form action="/search">


        <input type="text" name="keyword" class="form" placeholder="ユーザー名" value="{{ request('keyword') }}">
        {{-- value="{{ request('keyword') }}"入力したキーワードを検索結果表示後も保持 --}}

        <button type="submit"><img class="btn btn-success" src="images/search.png"></button>
    </form>

    {{-- 検索ワードの表示 --}}
    @if (!empty($keyword))
        <p>検索ワード：{{ $keyword }}</p>
    @endif

    {{-- 検索結果の表示 --}}
    @if (!empty($users) && count($users) > 0)
        {{-- 検索結果が存在するかどうかを確認。〇$users が空でなく、かつ、$users の数が1以上である場合〇 --}}
        {{-- empty()＝空であるか確認。　! は「否定」。つまり〇$users が空でない場合〇 --}}
    @else
        <p>該当するユーザーが見つかりませんでした。</p>
    @endif
    <ul>
        @foreach ($users as $user)
            {{-- as は、ループ内で現在の要素をどのように扱うかを指定 --}}
            <div class="user-list">
                <li class="user-item"><img class="redicon" src="{{ asset('storage/' . $user->images) }}">
                    {{-- 特定のユーザーの画像を表示するためのコード --}}
                    {{--  asset⇒publicディレクトリのパスを返す関数 --}}
                    {{ $user->username }}
                    {{-- userの名前 --}}


                    {{-- フォロー機能の実装 --}}
                    @php
                        $currentUser = Auth::user(); // ①現在のユーザーを取得
                        //$currentUser 現在ログインしているユーザーの情報を格納するために使用
                    @endphp

                    {{-- ②followed_idが$user->idのデータを検索する --}}
                    {{-- ログインユーザーのフォローしている人の中に、$user->id(今みているID)のデータが存在するか？ --}}
                    @if ($currentUser->following()->where('followed_id', $user->id)->exists())
                        {{-- exists　イグジストス --}}
                        {{-- ③フォロー解除ボタン※フォローしている場合(ture) --}}
                        {!! Form::open(['url' => route('unfollow', ['id' => $user->id]), 'method' => 'post']) !!}
                        @csrf <!-- CSRFトークンを追加 -->
                        <input type="submit" class=".follow-button" value="フォロー解除">
                        {!! Form::close() !!}
                    @else
                        {{-- ④フォローボタン ※フォローしいない場合(false) --}}
                        {!! Form::open(['url' => route('follow', ['id' => $user->id]), 'method' => 'post']) !!}
                        @csrf <!-- CSRFトークンを追加 -->
                        <input type="submit" class=".follow-button" value="フォローする">
                        {!! Form::close() !!}
                    @endif
                </li>
        @endforeach
    </ul>
    </div>
@endsection
