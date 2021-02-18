@extends('layouts.app')

@section('content')

<h1 class="text-center m-5">Your Posts</h1>

@foreach($user->post as $post)

<div id="over-roll">
    <div id="post" class="text-light">

        <div id="space" class="sub-bg-color"></div>

        <div id="name" class="d-flex direction-row justify-content-around align-items-center" style="height: 100px;">
            <h3>{{$post->user->name}}</h3>
            <div>
                <form action="{{ route('posts.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <input type="hidden" name="user_id" value="{{$post->user->id}}">
                    <button style="width:100px;" class="btn btn-secondary" type="submit"><i class="far fa-trash-alt"></i></button>
                </form>
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
