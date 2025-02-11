<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!-- asset関数→cssファイルと画像を呼び出す -->
    <!--スマホ,タブレット対応-->
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
            <p class="home-name">{{ Auth::user()->username }} さん<img src="images/icon1.png"></p>

            <!-- アコーディオンメニュー -->
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
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                {{-- 👇app/providers/AppServiceProviderに記載あり   --}}
                <p>フォロー数 {{ $followingCount }} 人</p>
                <a class="btn" href="{{ url('/followlist') }}">フォローリスト</a>

                <p>フォロワー数 {{ $followersCount }} 人</p>
                <a class="btn" href="{{ url('/followerlist') }}">フォロワーリスト</a>
            </div>
            <p class="btn"><a href="{{ url('/search') }}">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
