<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubPostsController extends Controller
{
    public function show($post)
    {
        $posts = [
            'my-first-post' => 'Hello, this is my first blog. I am...',
            'my-second-post' => 'Hey, my 2nd post I would show you...'
        ];

        if(! array_key_exists($post, $posts)) {
            abort(404, 'Sorry, that post was not found.');
        }

        return view('subpost', [
            // 'post' => $posts[$post] ?? 'Nothing here yet'
            'post' => $posts[$post] ?? 'Nothing here yet'
        ]);
    }
}
