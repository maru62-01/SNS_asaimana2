@extends('layouts.login')

@section('content')
    <!-- 投稿フォームの追加 -->

    <div class="post">
        {!! Form::open(['url' => '/post/create']) !!}
        {{-- <div class="item"> --}}
        @if (Auth::user()->images !== 'icon1.png')
            <img class="redicon" src="{{ asset('storage/' . Auth::user()->images) }}">
        @else
            <img class="redicon" src="{{ asset('images/icon1.png') }}">
        @endif
        {{-- 現在ログインしているユーザーの画像を取得 --}}

        @if ($errors->has('coment'))
            <div style="color:red;">
                {{ $errors->first('coment') }}
            </div>
        @endif
        {{-- エラー文 --}}

        {{-- <div class="item"> --}}
        <textarea name="coment" rows="15" cols="80" style="border: none;" minlength="1" maxlength="150"
            placeholder="投稿内容を入力してださい。"></textarea>
        {{-- </div> --}}

        {{-- <div class="item"> --}}
        <button type="submit"><img class="post-icon" src="images/post.png"></button>
        {!! Form::close() !!}
        {{-- </div> --}}
    </div>


    @foreach ($list as $list)
        {{-- as は、ループ内で現在の要素をどのように扱うかを指定 --}}

        @if ($list->user_id == Auth::id() || Auth::user()->isFollowing($list->user_id))
            {{-- フィルタリング条件を追加 --}}
            <div class="icon-container">
                <!-- 投稿を編集するための記述  -->
                {{-- 投稿一覧表示 --}}
                <ul class="postindex-list">
                    {{-- postテーブルとuserテーブルから情報を取得 --}}
                    <li> <img class="posticon" src="{{ asset('storage/' . $list->user->images) }}"></li>
                    <li class="username">
                        <span class="username-text">{{ $list->user->username }}</span>
                        <p class="post-text">{!! nl2br(e($list->post)) !!}</p>
                    </li>

                    <li class="time">
                        <div class="abc">
                            {{ $list->created_at->format('Y-n-j H:i') }}
                        </div>
                        @if ($list->user_id == Auth::id())
                            {{-- 編集ボタンの表示条件 --}}
                            <div class="button">
                                <P>
                                    <a class="js-modal-open" href="" post="{{ $list->post }}"
                                        post_id="{{ $list->id }}">
                                        <img class="editicon" src="images/edit.png">
                                    </a>
                                </P>

                                {{-- 投稿を削除するための記述 --}}
                                <P>
                                    <a class="trash-btn" href="/post/{{ $list->id }}/delete"
                                        onclick="return confirm('この投稿を削除します。よろしいですか？')">
                                        <img class="trashicon" src="images/trash.png" alt="delete">
                                    </a>

                                    {{-- <a class="trah-btn" href="/post/{{ $list->id }}/delete"
                                        onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                                        <img class="trashicon" src="images/trash.png">
                                        <img class="trashicon" src="images/trash-h.png"> --}}
                                    {{-- </a> --}}
                                </P>
                                {{-- aタグは基本get送信 --}}
                            </div>
                        @endif
                    </li>
                    {{-- ＄list-> post $list->user->username --}}
                </ul>

            </div>
        @endif {{-- フィルタリング条件の終了 --}}
    @endforeach
@endsection


{{-- 編集機能を実装、モーダル --}}
<!-- モーダルの中身 -->
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        {!! Form::open(['url' => '/post/update']) !!}
        {{-- <form action="'/post/update'" method="post"> --}}
        <div class="update_post">
            @if ($errors->any())
                {{-- 1つでもエラーがあるか　any --}}
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <textarea name="post" class="modal_post"></textarea>

            <input type="hidden" name="post_id" class="modal_id" value="">
            {{-- <input type="submit" value="images/edit.png"> --}}
            <button type="submit"><img class="edition_post" src="images/edit.png"></button>
            {{ csrf_field() }}
            {!! Form::close() !!}

            <a class="js-modal-close" href=""></a>
        </div>
    </div>
</div>
