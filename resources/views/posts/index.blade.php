@extends('layouts.login')

@section('content')
    <!-- 投稿フォームの追加 -->

    <div class="post">
        {!! Form::open(['url' => '/post/create']) !!}
        <img class="redicon" src="{{ asset('storage/' . Auth::user()->images) }}">
        <textarea name="coment" rows="15" cols="80" minlength="1" maxlength="150" placeholder="投稿内容を入力してださい。"></textarea>

        <button type="submit"><img class="post-icon" src="images/post.png"></a></button>
        {!! Form::close() !!}
    </div>

    {{-- 投稿一覧表示 --}}
    <div>
        @foreach ($list as $list)
            {{-- as は、ループ内で現在の要素をどのように扱うかを指定 --}}

            {{-- <img src="{{ asset('storage/' . $user->images) }}"> --}}

            <div class="icon-container">
                <!-- 投稿を編集するための記述  -->
                <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
                    <img class="editicon" src="images/edit.png"></a>

                {{-- 投稿を削除するための記述 --}}
                <a class="trah-btn" href="/post/{{ $list->id }}/delete"
                    onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                    <img class="trashicon" src="images/trash.png"></a>
                {{-- aタグは基本get送信 --}}


            </div>

            <ul>
                {{-- postテーブルとuserテーブルから情報を取得 --}}
                <li class="username">{{ $list->user->username }}</li>
                <li>{{ $list->post }}</li>
                <li>{{ $list->created_at }}</li>
                <li> <img class="redicon" src="{{ asset('storage/icon1.png') }}" alt="アイコン"></li>
                {{-- ＄list-> post $list->user->username --}}
            </ul>
        @endforeach
    </div>
@endsection


{{-- 編集機能を実装、モーダル --}}
<!-- モーダルの中身 -->
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        {!! Form::open(['url' => '/post/update']) !!}
        {{-- <form action="'/post/update'" method="post"> --}}
        <textarea name="post" class="modal_post"></textarea>

        <input type="hidden" name="post_id" class="modal_id" value="">
        {{-- <input type="submit" value="images/edit.png"> --}}
        <button type="submit"><img class="edition" src="images/edit.png"></button>
        {{ csrf_field() }}
        {!! Form::close() !!}

        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
