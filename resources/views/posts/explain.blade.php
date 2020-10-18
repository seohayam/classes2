@extends('layouts.app')

@section('content')
<h1 class="m-5 text-center">説明</h1>
<div class="text-center m-5 p-5 border rounded">
    <img class="border rounded" src="{{ asset('/img/CLASSE.png')}}">
    <hr>
    <h2 class="mt-5 mb-3">「時間割シェアアプリ」</h2>
    <p>これは、時間割をシェアするアプリです。自分の時間割をシェアして後輩達に伝えましょう。また、質問らんで質問もできます。質問はふさわしい質問をしください。</p>
</div>
@endsection
