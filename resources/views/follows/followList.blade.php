@extends('layouts.login')

{{-- @extends('ビューファイル名') --}}
{{-- 記述した場所に、指定したファイルの中身をそのまま表示 --}}

@section('content')
    {{-- フォローしているユーザーのアイコンを表示 --}}
    <section class="Follow-List">
        <div class="Follow-items">
            <h1 class="follow-list">フォローリスト</h1>
            <div class="follow-lineup">
                @foreach ($follows as $follow)
                    {{-- シンボリックリンクから画像を取得 --}}
                    <a href="{{ route('profile', ['id' => $follow->id]) }}">
                        <img class="follow-icon" src="{{ asset('storage/' . $follow->images) }}" alt="フォロー画像">
                    </a>
                @endforeach
            </div>
        </div>
        {{-- フォローしているユーザーの投稿を表示 --}}
        @foreach ($posts as $post)
            <div class="Post-item">
                <ul class="post-list">
                    {{-- 「この投稿をした人のID」 --}}
                    <li><a href="{{ route('profile', ['id' => $post->user->id]) }}">
                            {{-- 投稿者のアイコンにクリックできる --}}
                            <img class="follow-icon" src="{{ asset('storage/' . $post->user->images) }}" alt="投稿者の画像">
                        </a>
                    </li>
                    <li class="username">
                        <span class="username-text">
                            {{ $post->user->username }}</span>

                        <p class="posts">{!! nl2br(e($post->post)) !!}</p>
                    </li>
                    <li class="time"> {{ $post->created_at->format('Y-n-j H:i') }}</li>
                </ul>
            </div>
        @endforeach
    </section>
@endsection
