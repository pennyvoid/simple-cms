@extends('layouts.app')
@section('content')
            @include('partials.sidebar')
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <h5>Edit Profile</h5>
                    </div>
                    <div class="card-body">
                    <form action="{{route('profile.update',auth()->user())}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="email">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="google">Google:</label>
                        <input type="text" name="google" id="google" class="form-control" value="{{$user->google}}">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter:</label>
                        <input type="text" name="twitter" id="twitter" class="form-control" value="{{$user->twitter}}">
                        </div>
                        <div class="form-group">
                            <label for="about">About:</label>
                            <input id="about" type="hidden" name="about" value="{{$user->about}}">
                            <trix-editor input="about">
                            </trix-editor>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Upload Avatar:</label><br>
                            <input type="file" name="avatar" id="avatar">
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                   Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@endsection