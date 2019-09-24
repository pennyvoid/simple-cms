@extends('layouts.app')
@section('content')
    @include('partials.sidebar')
    <div class="col-lg-8">
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-success" href="{{route('post.create')}}"><span class="glyphicon glyphicon-plus"></span> Add Post</a>
        </div>
        <div class="card card-default">
        <div class="card-header"><h5>Posts</h5></div>
            <div class="card-body">
                @if ($posts->count() > 0)
                <table class="table table-hover">
                <thead>
                    <th style="border-top: none !important;">Image</th>
                    <th style="border-top: none !important;">Title</th>
                    <th style="border-top: none !important;">Category</th>
                    <th style="border-top: none !important;">Edit</th>
                    <th style="border-top: none !important;">Delete</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                            <img src="{{asset("storage/$post->featured")}}" alt="image" weidth="50px" height="50px">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td><a href="{{route('category.edit',$post->category->id)}}" style="text-decoration:none">{{$post->category->name}}</a></td>
                            <td>
                                @if ($post->trashed())
                                <form action="{{route('restore.post',$post->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info" style="color:white">
                                        <span class="glyphicon glyphicon-repeat"></span>  Restore
                                    </button>
                                </form>        
                                @else
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-info" style="color:white">
                                    <span class="glyphicon glyphicon-pencil"></span>  Edit
                                </a>    
                            @endif
                            </td>
                            <td>
                            <form action="{{route('post.destroy',$post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-trash"></span>  {{$post->trashed() ? 'Delete' : 'Trash'}}
                                </button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                {{$posts->links()}}
                 @else
                    <h3 class="text-center">No Post Yet</h3>
                @endif
            </div>
        </div> 
    </div>
@endsection