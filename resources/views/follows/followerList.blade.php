@extends('layouts.login')

@section('content')
    {{-- フォローされているユーザーのアイコンを表示 --}}
    <div class="container">
        <section class="Follow-List">
            <h1>Follower List</h1>
            <div class="Follow-items">
                @foreach ($followers as $follower)
                    {{-- シンボリックリンクから画像を取得 --}}
                    {{-- アイコンにクリックすると、profileページにつながる --}}
                    {{-- route('ルート名', ['パラメータ名' => 値]) --}}
                    <a href="{{ route('profile', ['id' => $follower->id]) }}">
                        <img src="{{ asset('storage/' . $follower->images) }}" alt="フォロワー画像">
                    </a>
                @endforeach
            </div>

            {{-- フォローされているユーザーの投稿を表示 --}}
            @foreach ($posts as $post)
                <div class="Post-item">
                    {{-- 投稿者のアイコンにクリックできる --}}
                    <a href="{{ route('profile', ['id' => $follower->id]) }}">
                        <img src="{{ asset('storage/' . $follower->images) }}" alt="フォロワー画像">
                    </a>

                    {{-- 投稿内容 --}}
                    <p>名前: {{ $post->user->username }}</p>
                    <p>投稿内容: {{ $post->post }}</p>
                    <p>投稿日: {{ $post->created_at }}</p>
                </div>
            @endforeach
        </section>
    </div>
@endsection
