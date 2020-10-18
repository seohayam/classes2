@extends('layouts.app')

@section('content')

<!-- 練習 -->



<!-- 検索ホーム -->
<div class="py-4">
    <div class="my-5 d-flex direction-row align-items-center justify-content-md-center h-100">
        <i class="fas fa-search fa-3x mx-4" style="color: white;"></i>
        <div class="d-flex justify-content-center h-100">
            <form id="search-form" action="{{ route('posts.search') }}" method="get">
                <div class="searchbar">
                    <input id="search" style="background-color: #cbc698 !important; margin: 0 10px !important; border-radius: 10px !important;" class="search_input" type="text" name="search" placeholder="学年や専攻を検索">
                    <input id="search_btn" type="submit" value="search" class="search_icon">
                </div>
            </form>
        </div>
    </div>
    <div id="search-result" class="text-center">
        @if(isset($count_result))
        <h3 class="text-white">{{$count_result}}</h3>
        @endif
    </div>
</div>

<!-- 一覧表示 -->
@foreach($posts as $post)
<!-- name = <h3>{{$post->user->name}}</h3>
<a class="btn border border-dark mx-2" href="{{ route('posts.show', $post->id) }}">詳細</a>
<img class="style" style="width:100%; filter: drop-shadow(0 0 10px black);　object-fit: contain;" src=" {{ asset('storage/image/'.$post->image) }}">
-->
<!-- <img src="data:image/png;base64,<?= $post->image ?>" class="style" style="filter: drop-shadow(0 0 10px black);　object-fit: contain;"> -->
<!-- <p>学部：{{$post->major}}</p>
<p>学年：{{$post->grade}}</p>
<p>お勧め：{{$post->recomend}}</p>
-->

<div id="over-roll">
    <div id="post" class="text-light">

        <div id="space" class="sub-bg-color"></div>

        <div id="name" class="d-flex direction-row justify-content-around align-items-center" style="height: 100px;">
            <h3>{{$post->user->name}}</h3>
            <div>
                <a href="{{ route('posts.show', $post->id) }}">
                    <i class="far fa-comment-dots fa-2x"></i>
                    <p class="m-0">質問</p>
                </a>
            </div>
        </div>

        @if(!$post->image)
            <div id="image" class="d-flex justify-content-center align-items-center border" style="height: 200px;">
                <i class="fas fa-images fa-5x"></i>
            </div>
        @else
            <div>
                <img src="data:image/png;base64,<?= $post->image ?>" style="width:100%; object-fit: contain;">
                <!-- <img style="width:100%; object-fit: contain;" src=" {{ asset('storage/image/'.$post->image) }}"> -->
            </div>
        @endif


        <div id="info" class="d-flex justify-content-center py-4">
            <div class="border border-top-0 rounded-bottom border-secondary px-5 py-3">
                <h3>学部</h3>
                <p>{{$post->major}}</p>
                <h3>学年</h3>
                <p>{{$post->grade}}</p>
                <h3>お勧めの授業</h3>
                <p>{{$post->recomend}}</p>
            </div>
        </div>

    </div>
</div>
@endforeach


@endsection
