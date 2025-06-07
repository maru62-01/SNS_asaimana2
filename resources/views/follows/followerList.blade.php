@extends('layouts.login')

@section('content')
    {{-- フォローされているユーザーのアイコンを表示 --}}
    <section class="Follow-List">
        <div class="Follow-items">
            <h1 class="follow-list">フォロワーリスト</h1>
            <div class="follow-lineup">
                @foreach ($followers as $follower)
                    {{-- シンボリックリンクから画像を取得 --}}
                    {{-- アイコンにクリックすると、profileページにつながる --}}
                    {{-- route('ルート名', ['パラメータ名' => 値]) --}}
                    <a href="{{ route('profile', ['id' => $follower->id]) }}">
                        @if ($follower->images !== 'icon1.png')
                            <img class="follow-icon" src="{{ asset('storage/' . $follower->images) }}" alt="フォロワー画像">
                        @else
                            <img class="follow-icon" src="{{ asset('images/icon1.png') }}" alt="フォロワー画像">
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
        {{-- フォローされているユーザーの投稿を表示 --}}
        @foreach ($posts as $post)
            <div class="Post-item">
                <ul class="post-list">
                    {{-- 投稿者のアイコンにクリックできる --}}
                    <li><a href="{{ route('profile', ['id' => $post->user->id]) }}">
                            {{-- 「この投稿をした人のID」 --}}
                            @if ($post->user->images !== 'icon1.png')
                                <img class="follow-icon" src="{{ asset('storage/' . $post->user->images) }}" alt="投稿者の画像">
                            @else
                                <img class="follow-icon" src="{{ asset('images/icon1.png') }}" alt="投稿者の画像">
                            @endif
                        </a>
                    </li>
                    {{-- 投稿内容 --}}
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
