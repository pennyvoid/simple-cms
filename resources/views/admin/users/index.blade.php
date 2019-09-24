@extends('layouts.app')
@section('content')
    @include('partials.sidebar')
    <div class="col-lg-8">
        <div class="card card-default">
        <div class="card-header"><h5>Users</h5></div>
            <div class="card-body">
                @if ($users->count() > 0)
                <table class="table table-hover">
                <thead>
                    <th style="border-top: none !important;">Image</th>
                    <th style="border-top: none !important;">Name</th>
                    <th style="border-top: none !important;">Posts</th>
                    <th style="border-top: none !important;">Permission</th>
                    <th style="border-top: none !important;">Delete</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                            <img style="border-radius:50%" src="{{($user->avatar != 'default.jpg')?asset("storage/".$user->avatar) :asset('uploads/profile/default.jpg')}}" alt="image" weidth="70px" height="70px">
                            </td>
                            <td>
                            <a href="{{route('users.show',$user->id)}}" style="text-decoration:none">{{$user->name}}</a>
                            </td>
                        <td>{{$user->posts->count()}}</td>
                        <td>
                            
                            @if(!$user->mainAdmin())
                            @if (!$user->isAdmin())
                            <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Make Admin</button>
                            </form>
                            @else
                            <form action="{{route('users.make-writer',$user->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Make Writer</button>
                            </form>
                            @endif
                            @endif
                            </td>       
                            <td>
                            @if(!$user->mainAdmin())
                            <form action="{{route('users.destroy',$user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                 @else
                    <h3 class="text-center">No Post Yet</h3>
                @endif
            </div>
        </div> 
    </div>
@endsection