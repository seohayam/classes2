<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $posts = $post->latest()->paginate(2);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        if($request->file('image')->isValid()){

            $post->user_id = $request->user_id;
            $post->major = $request->major;
            $post->grade = $request->grade;
            $post->recomend = $request->recomend;

            // 練習用
            // $path = $request->file('image')->store('public/image');
            // $post->image = basename($path);

            // 本番用
            $image_binary = base64_encode(file_get_contents($request->image->getRealPath()));
            $post->image = $image_binary;

            $post->save();

        }

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post = Post::with('user')->find($post_id);

        return view('posts.show', ['id' => $post_id, 'post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('post')->find($id);

        return view('posts.delete', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function search(Request $request)
    {
        $results_post = Post::where('major','like', "%{$request->search}%")
                            ->orWhere('grade','like', "%{$request->search}%")
                            ->orWhere('recomend','like', "%{$request->search}%")
                            ->paginate('2');
        // $results_user = User::where('name', 'like', "%{$request->search}%")->paginate('2');

        $count_result = '検索結果（投稿者名　'.count($results_post).'件）';

        return view('posts.index', ['posts' => $results_post, 'count_result' => $count_result]);
    }

    public function explain()
    {
        return view('posts.explain');
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->post_id)->delete();

        return redirect('/posts/'.$request->user_id.'/edit/');
   
    }
}
