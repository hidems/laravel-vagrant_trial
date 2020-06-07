<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function show($slug)
    {
        // $post = \DB::table('posts')->where('slug', $slug)->first();
        //
        // dd($post);
        //
        // if(!$post) {
        //     abort(404);
        // }
        //
        // return view('post', [
        //     'post' => $post
        // ]);


        return view('post', [
            'post' => Post::where('slug', $slug)->firstOrFail()
        ]);

    }
}
