@extends('layouts.app')

@section('content')
        @include('partials.sidebar')
        
        <div class="col-md-2">
        <div class="card">
            <div class="card bg-primary text-white text-center">
               <h3 class="text-center mt-1">POSTS</h3>
            </div>
            <div class="card-body text-center">
                <h1 class="text-center">{{$posts}}</h1>
            </div>
        </div>
        </div>
           <div class="col-md-2">
        <div class="card">
            <div class="card bg-danger text-white text-center">
               <h3 class="text-center mt-1">TRASHED</h3>
            </div>
            <div class="card-body text-center">
                <h1 class="text-center">{{$trashed}}</h1>
            </div>
        </div>
        </div>
           <div class="col-md-2">
        <div class="card">
            <div class="card bg-warning text-white text-center">
               <h3 class="text-center mt-1">CATEGORY</h3>
            </div>
            <div class="card-body text-center">
            <h1 class="text-center">{{$categories}}</h1>
            </div>
        </div>
        </div>
           <div class="col-md-2">
        <div class="card">
            <div class="card bg-success text-white text-center">
               <h3 class="text-center mt-1">TAGS</h3>
            </div>
            <div class="card-body text-center">
                <h1 class="text-center">{{$tags}}</h1>
            </div>
        </div>
        </div>
        
     
@endsection
