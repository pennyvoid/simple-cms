<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard')
            ->with('posts', Post::all()->count())
            ->with('trashed', Post::onlyTrashed()->count())
            ->with('categories', Category::all()->count())
            ->with('tags', Tag::all()->count());
    }
}
