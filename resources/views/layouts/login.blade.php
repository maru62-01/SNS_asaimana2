<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
</head>

<!-- asset関数→cssファイルと画像を呼び出す -->
<!--スマホ,タブレット対応-->
{{-- Bootstrap --}}
<meta name="viewport" content="width=device-width,initial-scale=1" />

<!--サイトのアイコン指定-->
<link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
<link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
<link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
<link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
<!--iphoneのアプリアイコン指定-->
<link rel="apple-touch-icon-precomposed" href="画像のURL" />
<!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id = "head">
            <h1><a href="{{ url('/top') }}"><img class="top-icon" src="images/atlas.png"></a></h1>
            <p class="home-name">
                <img class="redicon" src="{{ asset('storage/' . Auth::user()->images) }}">
                <span>{{ Auth::user()->username }} さん</span>
            </p> <!-- アコーディオンメニュー -->
            <div id="section-cont">
                <button type="button" class="menu-btn">
                    <span class="inn"></span>
                </button>
                <div class="menu">
                    <ul>
                        <li class="acordion-code"><a href="{{ url('/top') }}">HOME</a></li>
                        <li class="acordion-code"><a href="{{ url('/editprofile') }}">プロフィール編集</a></li>
                        <li class="acordion-code"><a href="{{ url('/logout') }}">ログアウト</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
            {{-- イールド --}}
            <div id="side-bar">
                <div id="confirm">
                    <p class="side-name">{{ Auth::user()->username }}さんの</p>
                    {{-- 👇app/providers/AppServiceProviderに記載あり   --}}
                    <div class="follow">
                        <p class="follow-number">フォロー数</p>
                        <p> {{ $followingCount }} 人</p>
                    </div>
                    <a href="{{ url('/followlist') }}" class="btn btn-primary custom-class">フォローリスト</a>
                    <div class="follow">
                        <p class="follow-numbers">フォロワー数</p>
                        <p> {{ $followersCount }} 人</p>
                    </div>
                    <a href="{{ url('/followerlist') }}" class="btn btn-primary custom-class">フォロワーリスト</a>
                    <p><a href="{{ url('/search') }}" class="btn btn-primary customs-class">ユーザー検索</a></p>
                </div>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
