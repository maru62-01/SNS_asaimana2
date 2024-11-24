@extends('layouts.login')

@section('content')
    {{-- ユーザー名検索 --}}
    <form action="/search" method="">


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
        <ul>
            @foreach ($users as $user)
                {{-- as は、ループ内で現在の要素をどのように扱うかを指定 --}}
                <li>{{ $user->username }}
                    <img src="{{ asset('images/' . $user->images) }}">

                </li>
            @endforeach
        </ul>
    @else
        <p>該当するユーザーが見つかりませんでした。</p>
    @endif

@endsection
