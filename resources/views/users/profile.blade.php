@extends('layouts.login')
@section('content')
    {{-- プロフィール編集 --}}

    {{-- 他ユーザーのプロフィールを開く --}}
    {{-- <a href="{{ route('profile', ['id' => $user->id]) }}"> --}}

    <div class="profile-items">
        <img src="{{ asset('storage/' . $user->images) }}" alt="プロフィール画像">
        <h1>ユーザー名{{ $user->username }}</h1> <!-- ユーザー名 -->
        <h2>自己紹介</h2> <!-- 自己紹介 -->
    </div>
    {{-- </a> --}}

    {{-- フォローする/解除ボタンの表示 --}}
    @php
        $currentUser = Auth::user(); // 現在のユーザーを取得
        //$currentUser 現在ログインしているユーザーの情報を格納するために使用
    @endphp

    @if ($currentUser->following()->where('followed_id', $user->id)->exists())
        {{-- exists その条件に一致するデータが 存在するかどうか  --}}
        {{-- フォロー解除ボタン --}}
        {!! Form::open(['url' => route('unfollow', ['id' => $user->id]), 'method' => 'post']) !!}
        @csrf <!-- CSRFトークンを追加 -->
        <input type="submit" class="bth bth-danger" value="フォロー解除">
        {!! Form::close() !!}
    @else
        {{-- フォローボタン --}}
        {!! Form::open(['url' => route('follow', ['id' => $user->id]), 'method' => 'post']) !!}
        @csrf <!-- CSRFトークンを追加 -->
        <input type="submit" class="bth bth-primary" value="フォローする">
        {!! Form::close() !!}
    @endif


    <!-- 投稿表示 -->
    <div class="user-posts">
        <h3>{{ $user->username }}</h3>
        @foreach ($posts as $post)
            <div class="post-item">
                <p>{{ $post->post }}</p>
                <p>{{ $post->created_at }}</p>
            </div>
        @endforeach
    @endsection
