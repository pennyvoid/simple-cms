@extends('layouts.app')
@section('content')
            @include('partials.sidebar')
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        {!!isset($post) ? '<h5>Edit Post</h5>' : '<h5>Create Post</h5>'!!}
                    </div>
                    <div class="card-body">
                    <form action="{{ isset($post) ? route('post.update',$post->id):route('post.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($post))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{isset($post) ? $post->title :''}}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" id="category"  class="form-control">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if (isset($post))
                                        @if ($category->id == $post->category->id)
                                            selected
                                        @endif
                                    @endif
                                    >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content">Content:</label>
                            <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content :'' }}">
                            <trix-editor input="content">
                            </trix-editor>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags:</label>
                            <select name="tags[]" id="tags"  class="form-control tag-selector" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                    @if (isset($post))
                                        @if ($post->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                    >{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (isset($post))
                            <div class="form-group">
                                <img src="{{asset("storage/$post->featured")}}" alt="image" weidth="200px" height="200px">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="featured">Featured Image:</label><br>
                            <input type="file" name="featured" id="featured" >
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                   {{isset($post) ? 'Update Post' :'Store Post'}}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@endsection