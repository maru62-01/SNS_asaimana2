@extends('layouts.login')

{{-- @extends('ビューファイル名') --}}
{{-- 記述した場所に、指定したファイルの中身をそのまま表示 --}}

@section('content')
    {{-- フォローしているユーザーのアイコンを表示 --}}
    <div class="container">
        <section class="Follow-List">
            <h1>Follow List</h1>
            <div class="Follow-items">
                @foreach ($follows as $follow)
                    {{-- シンボリックリンクから画像を取得 --}}
                    <a href="{{ route('profile', ['id' => $follow->id]) }}">
                        <img src="{{ asset('storage/' . $follow->images) }}" alt="フォロー画像">
                    </a>
                @endforeach
            </div>
            {{-- フォローしているユーザーの投稿を表示 --}}
            @foreach ($posts as $post)
                <div class="Post-item">
                    {{-- 投稿者のアイコンにクリックできる --}}

                    <a href="{{ route('profile', ['id' => $post->user->id]) }}">
                        {{-- 「この投稿をした人のID」 --}}
                        <img src="{{ asset('storage/' . $post->user->images) }}" alt="投稿者の画像"> </a>
                    <p>:{{ $post->user->username }}</p>
                    <p>:{{ $post->post }}</p>
                    <p>:{{ $post->created_at }}</p>
            @endforeach
        </section>
    </div>
@endsection
