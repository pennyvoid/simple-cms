@extends('layouts.app')
@section('content')
    @include('partials.sidebar')
    <div class="col-lg-8">
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-success" href="{{route('tags.create')}}"><span class="glyphicon glyphicon-plus"></span> Add Tag</a>
        </div>
        <div class="card card-default">
            <div class="card-header"><h5>Tags</h5></div>
            <div class="card-body">
                @if ($tags->count() > 0)
                <table class="table table-hover">
                <thead>
                    <th style="border-top: none !important;">Tag Name</th>
                    <th style="border-top: none !important;">Post Count</th>
                    <th style="border-top: none !important;">Edit</th>
                    <th style="border-top: none !important;">Delete</th>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>
                                {{$tag->name}}
                            </td>
                            <td>{{$tag->posts->count()}}</td>
                            <td>
                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info" style="color:white">
                                    <span class="glyphicon glyphicon-pencil"></span>  Edit
                                </a>
                            </td>
                            <td>
                                <form action="{{route('tags.destroy',$tag->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="color:white">
                                        <span class="glyphicon glyphicon-trash"></span>  Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                 @else
                    <h3 class="text-center">No Tag Yet</h3>
                @endif
            </div>
        </div> 
    </div>
@endsection