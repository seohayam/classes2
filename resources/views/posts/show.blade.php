@extends('layouts.app')

@section('content')
<div id="over-roll">
    <div id="post" class="text-light">

        <div id="name" class="text-center border rounded-pill m-5">
            <h3>{{$post->user->name}}</h3>
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




<!-- 質問と回答 -->
<div id="qa" class="d-flex justify-content-md-around flex-row m-5">

    <div class="q border p-5 border-secondary">
        <div>
            <h4 class="card-title text-center text-primary">Q</h4>

            <table class="table table-striped text-center border-0 mt-5 text-info">
                <thead>
                    <tr>
                        <th class="border-0" scope="col">質問者</th>
                        <th class="border-0" scope="col">内容</th>
                    </tr>
                </thead>
                @foreach($post->comment as $question)
                <tbody>
                    <tr>
                        <td>{{$question->user->name}}</td>
                        <td>{{$question->comment}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>

        <!-- フォーム 質問 -->
        <div class="mt-5">

            @error('user_id')
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Caution</h4>
                <p>{{$message}}</p>
            </div>
            @enderror

            @error('user_id')
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Caution</h4>
                <p>{{$message}}</p>
            </div>
            @enderror

            @error('comment')
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Caution</h4>
                <p>{{$message}}</p>
            </div>
            @enderror

            <hr>

            <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data" class="mx-5 mb-5">
                @csrf
                <div class="form-group">
                    <label>質問</label>
                    <textarea name="comment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="回答を記入してください" style="width: 100%;"></textarea>
                </div>

                <input name="user_id" type="hidden" value="{{Auth::id()}}">
                <input name="post_id" type="hidden" value="{{$post->id}}">

                <div class="text-center">
                    <input type="submit" class="btn btn-info" value="投稿する">
                </div>

            </form>

        </div>

    </div>

    <div class="a border p-5 border-secondary">

        <div>
            <h4 class="card-title text-center text-danger">A</h4>

            <table class="table table-striped text-center border-0 text-danger mt-5">
                <thead>
                    <tr>
                        <th class="border-0" scope="col">回答者</th>
                        <th class="border-0" scope="col">内容</th>
                    </tr>
                </thead>
                @foreach($post->answer as $a)
                <tbody>
                    <tr>
                        <td>{{$a->user->name}}</td>
                        <td>{{$a->answer}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>


        <!-- フォーム　回答 -->
        <div class="mt-5">

            @error('user_id')
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Caution</h4>
                <p>{{$message}}</p>
            </div>
            @enderror
            @error('user_id')
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Caution</h4>
                <p>{{$message}}</p>
            </div>
            @enderror
            @error('answer')
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Caution</h4>
                <p>{{$message}}</p>
            </div>
            @enderror

            <hr>

            <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data" class="mx-5 mb-5">
                @csrf
                <div class="form-group">
                    <label>回答</label>
                    <textarea name="answer" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="回答を記入してください"></textarea>
                </div>

                <input name="user_id" type="hidden" value="{{Auth::id()}}">
                <input name="post_id" type="hidden" value="{{$post->id}}">

                <div class="text-center">
                    <input type="submit" class="btn btn-info" value="投稿する">
                </div>

            </form>

        </div>

    </div>

    @endsection