<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav id="origin_nav" class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
<!-- always exsits -->
            <div class="d-flex direction-row align-items-center mb-3">
                <a class="navbar-brand logo-size mr-md-3" href="{{ url('/posts') }}">
                    <img id="logo" class="border rounded-circle" src="{{ asset('/img/CLASSE.png')}}">
                </a>
                @if(Auth::user())
                <h2 class="m-0 text-center">wellcome {{ Auth::user()->name}}</h2>
                @else
                    <h2 class="m-0">wellcome</h2>
                @endif
            </div>
<!-- icons -->
            <div id="icons" style="width: 100%;" class="d-flex justify-content-around">
                <a class="navbar-brand text-center m-0" href="{{ url('/posts') }}">
                    <i class="fas fa-home fa-2x"></i>
                    <p class="font-small">HOME</p>
                </a>
                <a class="navbar-brand text-center m-0" href="{{ route('posts.explain') }}">
                    <i class="fas fa-info-circle fa-2x"></i>
                    <p class="font-small">説明</p>
                </a>
              
            @guest
                <a class="navbar-brand text-center m-0" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt fa-2x"></i>
                    <p class="font-small">ログイン</p>
                </a>
                @if (Route::has('register'))
                <a class="navbar-brand text-center m-0" href="{{ route('register') }}">
                    <i class="fas fa-user-plus fa-2x"></i>
                    <p class="font-small">登録</p>
                </a>
                @endif
            @else
                <a class="navbar-brand text-center m-0" href="{{ route('posts.create') }}">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <p class="font-small">投稿</p>
                </a>
                <a class="navbar-brand text-center m-0" href="{{ route('users.show', Auth::id() ) }}">
                    <i class="fas fa-camera fa-2x"></i>
                    <p class="font-small">Your Posts</p>
                </a>
                <!-- ログアウト -->
                <a class="navbar-brand text-center m-0" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
                    <p class="font-small">ログアウト</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                </form>                             
            @endguest
            </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        const dleteConf = () => {        
            if(!window.confirm('本当に削除しますか？')){
                window.alert('キャンセルされました'); 
                return false;
            }
                document.trash.submit();
                alert("消去完了しました");
        };
    </script>
</body>
</html>
