@extends('layouts.app')

@section('content')

<div class="m-5 text-center">
    <h1>投稿</h1>
</div>
<!-- エラー -->
@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Caution</h4>
    @error('user_id')
        <p>{{$message}}</p>
    @enderror
    @error('major')
        <p>{{$message}}</p>
    @enderror
    @error('grade')
        <p>{{$message}}</p>
    @enderror
    @error('recomend')
        <p>{{$message}}</p>
    @enderror
    @error('image')
        <p>{{$message}}</p>
    @enderror
    </div>
@endif

<!-- フォーム -->
<div class="">
    <form name="createHome" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="mx-5 mb-5">
    @csrf
    <div class="form-group">
        <hr>
        <label>学部</label>
            <input name="major" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="例：外国語学部" value="{{old('major')}}">    
        <hr>
        <label>学年</label>
            <input name="grade" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="例：2年" value="{{old('grade')}}">
        <hr>
        <label>お勧めの授業</label>
            <input name="recomend" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="例：英米文学の授業" value="{{old('recomend')}}">
        <hr>
    </div>

    <div class="form-group d-flex flex-column flex-md-row mt-5 text-center">
        <div class="mr-md-5">
            <label for="exampleFormControlFile1">あなたの時間割（画像）</label>
        </div>
        <div class="text-center text-md-left btn" onclick="check()">
            <label>
                <i class="far fa-file fa-5x bg-dark rounded p-1"></i>
                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" style="visibility: hidden;">
                <div id="imgAdd" class="alert alert-success" role="alert">
                    画像追加準備完了
                </div>
            </label>
        </div>
    </div>
    
    <div class="text-center">
        <h5>投稿する</h5>
        <button id="createSubmit" class="btn btn-secondary" type="submit"><i class="far fa-plus fa-3x"></i></button>
    </div>
        <!-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> -->
    </form>
</div>

@endsection
