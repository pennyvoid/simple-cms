@extends('layouts.app')
@section('content')
            @include('partials.sidebar')
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        {!!isset($tag) ? '<h5>Edit Tag</h5>' : '<h5>Create Tag</h5>'!!}
                    </div>
                    <div class="card-body">
                    <form action="{{isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}" method="post" >
                        @csrf
                        @if (isset($tag))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Tag Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{isset($tag) ? $tag->name : ''}}">
                        </div>
                        <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">
                                {{isset($tag) ? 'Update Tag' : 'Store Tag'}}
                            </button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@endsection