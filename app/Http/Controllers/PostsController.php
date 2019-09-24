<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('category')->only(['create', 'store']);
    }
    public function index()
    {
        $posts = Post::withoutTrashed()->paginate(5);

        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        if ($tags->count() == 0) {
            session()->flash('info', 'You must have atleast a tag before attempting to create a post');
            return redirect(route('tags.create'));
        }

        return view('admin.posts.cu')->with('categories', Category::all())->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    { 
        $featured = $request->file('featured')->storeAs(
            'posts',
            Carbon::now()->format('d-m-Y') . '@' . $request->file('featured')->getClientOriginalName()
        );
        $tags = Tag::all();
        if ($tags->count() == 0) {
            session()->flash('info', 'You must have atleast a tag before attempting to create a post');
            return redirect(route('tags.create'));
        }
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => $featured,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => auth()->user()->id
        ]);
        $post->tags()->attach($request->tags);
        session()->flash('success', "Post Created successfully");
        return redirect(route('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.cu')->with('categories', Category::all())->with('tags', Tag::all())->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['content', 'category']);
        if (Post::where('title', $request->title)->exists()) {
            session()->flash('info', "{$request->title} Title has already been taken");
            return redirect()->back();
        } else {
            $data['title'] = $request->title;
        }
        if ($request->hasFile('featured')) {
            $featured = $request->file('featured')->storeAs(
                'posts',
                Carbon::now()->format('d-m-Y') . '@' . $request->file('featured')->getClientOriginalName()
            );
            $post->deleteImage();
            $data['featured'] = $featured;
        }
        $post->tags()->sync($request->tags);
        $post->update($data);
        session()->flash('success', "Post : ' {$post->title} ' updated successfully");
        return redirect(route('posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('error', " Trashed Post: {$post->title} deleted successfully");
        } else {
            $post->delete();
            session()->flash('error', "Post: {$post->title} trashed successfully");
        }
        return redirect()->back();
    }
    public function trashed()
    {
        $trasheds = Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts', $trasheds);
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', "Post: {$post->title} restored to 'Posts' successfully");
        return redirect(route('trashed.posts'));
    }
}
