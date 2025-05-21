@extends('layouts.login')

@section('content')
    {{-- プロフィール編集 --}}

    {{-- 他ユーザーのプロフィールを開く --}}

    <div class="profile-items">
        <ul class="profile-list">
            <li><img class="others_icon" src="{{ asset('storage/' . $user->images) }}" alt="プロフィール画像">
            </li>
            <li class="username_bio">
                <p class="profile-username">ユーザー名　　{{ $user->username }}</p> <!-- ユーザー名 -->
                <p class="profile-bio">自己紹介　　　{{ $user->bio }}</p>
            </li>
            <!-- 自己紹介 -->
            {{-- フォローする/解除ボタンの表示 --}}
            <li class="profile-button">@php
                $currentUser = Auth::user(); // 現在のユーザーを取得
                //$currentUser 現在ログインしているユーザーの情報を格納するために使用
            @endphp

                @if ($currentUser->following()->where('followed_id', $user->id)->exists())
                    {{-- exists その条件に一致するデータが 存在するかどうか  --}}
                    {{-- フォロー解除ボタン --}}
                    {!! Form::open(['url' => route('unfollow', ['id' => $user->id]), 'method' => 'post']) !!}
                    @csrf <!-- CSRFトークンを追加 -->
                    <button type="submit" class="btn btn-danger customs">フォロー解除</button>
                    {!! Form::close() !!}
                @else
                    {{-- フォローボタン --}}
                    {!! Form::open(['url' => route('follow', ['id' => $user->id]), 'method' => 'post']) !!}
                    @csrf <!-- CSRFトークンを追加 -->
                    <button type="submit" class="btn btn-info customs">フォローする</button>
                    {!! Form::close() !!}
                @endif
            </li>
        </ul>
    </div>



    <!-- 投稿表示 -->
    @foreach ($posts as $post)
        <div class="icon-container">

            <ul class="postindex-list">
                <li><img class="redicon" src="{{ asset('storage/' . $user->images) }}" alt="プロフィール画像">
                </li>

                <li class="username">
                    <span class="username-text">{{ $user->username }}</span>
                    <p class="post-text">{!! nl2br(e($post->post)) !!}</p>
                </li>
                <li class="time">
                    <p>{{ $post->created_at->format('Y-n-j H:i') }}</p>
                </li>



                {{-- <p>{{ $user->username }}</p>
                <p><img class="redicon" src="{{ asset('storage/' . $user->images) }}" alt="プロフィール画像"></p>
                <p>{{ $post->post }}</p> --}}
                {{-- <p>{{ $post->created_at->format('Y-n-j H:i') }}</p> --}}
            </ul>
        </div>
    @endforeach
@endsection
