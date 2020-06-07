<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Test page to show only name in URL (Ex. http://192.168.33.11/request?name=John)
Route::get('request', function () {
    // $name = request('name');
    return view('request', [
        'name' => request('name')
    ]);
});

// No controller and operate in this file to show pages
Route::get('posts_dir/{POST}', function($post) {
    $posts = [
        'my-first-post' => 'Hello, this is my first blog. I am...',
        'my-second-post' => 'Hey, my 2nd post I would show you...'
    ];

    if(! array_key_exists($post, $posts)) {
        abort(404, 'Sorry, that post was not found.');
    }

    return view('post', [
        // 'post' => $posts[$post] ?? 'Nothing here yet'
        'post' => $posts[$post] ?? 'Nothing here yet'
    ]);
});

// Call Controller
Route::get('subposts/{post}', 'SubPostsController@show');

// Call Controller
Route::get('posts/{post}', 'PostsController@show');

