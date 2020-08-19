@extends('layouts.app')

@section('content')

<!-- 初期画面 -->
<div>
    <img style="width:100%;" src="{{ asset('/img/classes.png') }}">
</div>

<!-- 説明 -->
<div id="explain_btn" class="d-flex align-items-center d-flex justify-content-center my-md-5" style="height: 100px;">
    <div class="text-center">
        <a class="btn btn-outline-secondary px-md-5 py-md-3" href="{{ route('posts.explain') }}">説明を読む</a>
    </div>
</div>
<hr class="m-0">

<!-- 投稿orログインボタン -->
<div id="post_btn" class="d-flex align-items-center d-flex justify-content-center my-md-5" style="height: 100px;">
    @guest
    <div>
        <div class="text-center">
            <a class="btn btn-outline-secondary px-md-5 py-md-3 mx-3" href="{{ route('login') }}">{{ __('Login') }}</a>
            <a class="btn btn-outline-secondary px-md-5 py-md-3 mx-3" href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </div>
    @else
    <div class="text-center">
        <a class="btn btn btn-outline-secondary px-md-5 py-md-3" href="{{ route('posts.create') }}">投稿する</a>
        <a class="btn btn-outline-secondary px-md-5 py-md-3" href="{{ route('posts.edit', Auth::id() ) }}">Your Posts</a>        
    </div>
    @endguest
</div>
<hr class="m-0 mb-5">

<!-- 時間割一覧 -->
<div class="text-center">
    <a style="text-decoration: none;" href="{{ route('posts.index') }}"><h1 id="classes" class="text-dark">Classes（時間割一覧）</h1></a>
</div>


<!-- 検索ホーム -->
<div class="py-4">
    <div class="my-5 container h-100">
        <div class="d-flex justify-content-center h-100">
            <form action="{{ route('posts.search') }}" method="get">
                <div class="searchbar">
                    <input id="search" class="search_input" type="text" name="search" placeholder="学年や専攻を検索">                    
                    <input id="search_btn" type="submit" value="search" class="search_icon">
                    <i class="fas fa-search"></i>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center">
    @if(isset($count_result))
        <h3>{{$count_result}}</h3>
    @endif
    </div>
</div>


@foreach($posts as $post)

<div class="p-5 m-5 border rounded-pill">
    <div class="row">

        <div class="col-md-2 mx-md-5 my-5 my-md-0 d-flex align-items-center">
            <div class="border rounded-pill text-center" style="width: 100%">
                <h3 class="m-0 py-3">{{$post->user->name}}</h3>
            </div>
        </div>
        <div class="col-md-4 p-0 ml-md-5 pl-md-5 mr-md-3" style="height: 400px;">
            <img src="data:image/png;base64,<?= $post->image ?>" style="width:100%; height: 100%; object-fit: contain;">
        </div>
        <div id="card_buttom" class="col-md-4 p-0 mb-5 mb-md-0">
            <div class="card" style="width:211px; height:100%;">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        <a id="detail_btn" href="{{ route('posts.show', $post->id) }}" class="btn border border-info mt-5 m-md-0 px-5 py-3">詳細</a> 
                    </h4>
                    <hr class="my-md-3">
                    <p class="card-text text-center">{{$post->opinion}}</p>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
@endforeach

@endsection
