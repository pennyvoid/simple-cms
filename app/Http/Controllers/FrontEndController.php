<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('index')
            ->with('setting', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('first_post', Post::latest()->first())
            ->with('second_post', Post::latest()->skip(1)->first())
            ->with('third_post', Post::latest()->skip(2)->first())
            ->with('social', Tag::find(5))
            ->with('tutorial', Tag::find(3))
            ->with('career', Tag::find(4))
            ->with('network', Tag::find(6))
            ->with('setting', Setting::first());
    }
    public function single($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');
        return view('single')
            ->with('post', $post)
            ->with('setting', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('next', Post::find($next_id))
            ->with('prev', Post::find($prev_id))
            ->with('tags', Tag::all());
    }
    public function category($id)
    {
        $category = Category::where('id', $id)->first();

        return view('category')
            ->with('category', $category)
            ->with('setting', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('tags', Tag::all());
    }
    public function tag($id)
    {
        $tag = Tag::where('id', $id)->first();

        return view('tag')
            ->with('tag', $tag)
            ->with('setting', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('tags', Tag::all());
    }

    public function user($id)
    {
        $user = User::where('id', $id)->first();

        return view('user')
            ->with('user', $user)
            ->with('setting', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('tags', Tag::all());
    }
}
