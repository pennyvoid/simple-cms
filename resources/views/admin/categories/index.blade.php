@extends('layouts.app')
@section('content')
    @include('partials.sidebar')
    <div class="col-lg-8">
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-success" href="{{route('category.create')}}"><span class="glyphicon glyphicon-plus"></span> Add Category</a>
        </div>
        <div class="card card-default">
            <div class="card-header"><h5>Categories</h5></div>
            <div class="card-body">
                @if ($categories->count() > 0)
                <table class="table table-hover">
                <thead>
                    <th style="border-top: none !important;">Category Name</th>
                    <th style="border-top: none !important;">Post Count</th>
                    <th style="border-top: none !important;">Edit</th>
                    <th style="border-top: none !important;">Delete</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                        <td>{{$category->posts->count()}}</td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-info" style="color:white">
                                    <span class="glyphicon glyphicon-pencil"></span>  Edit
                                </a>
                            </td>
                            <td>
                                <form action="{{route('category.destroy',$category->id)}}" method="post">
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
                    <h3 class="text-center">No Category Yet</h3>
                @endif
            </div>
        </div> 
    </div>
@endsection