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
                    <img src="{{ asset('storage/' . $follow->images) }}">
                @endforeach
            </div>
            {{-- フォローしているユーザーの投稿を表示 --}}
            @foreach ($posts as $post)
                <p><img src="{{ asset('storage/' . $follow->images) }}"></p>
                <p>:{{ $post->user->username }}</p>
                <p>:{{ $post->post }}</p>
                <p>:{{ $post->created_at }}</p>
            @endforeach
        </section>
    </div>
@endsection
