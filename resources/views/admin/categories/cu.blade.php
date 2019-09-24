@extends('layouts.app')
@section('content')
            @include('partials.sidebar')
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        {!!isset($category) ? '<h5>Edit Category</h5>' : '<h5>Create Category</h5>'!!}
                    </div>
                    <div class="card-body">
                    <form action="{{isset($category) ? route('category.update',$category->id) : route('category.store') }}" method="post" >
                        @csrf
                        @if (isset($category))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{isset($category) ? $category->name : ''}}">
                        </div>
                        <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">
                                {{isset($category) ? 'Update Category' : 'Store Category'}}
                            </button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@endsection