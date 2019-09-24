@extends('layouts.app')
@section('content')
            @include('partials.sidebar')
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <h5>Edit Blog Setting</h5>
                    </div>
                    <div class="card-body">
                    <form action="{{route('settings.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">Site Name:</label>
                        <input type="text" name="site_name" id="site_name" class="form-control" value="{{$setting->site_name}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{$setting->address}}">
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{$setting->contact_number}}">
                        </div>
                        <div class="form-group">
                            <label for="contact_email">Contact Email:</label>
                        <input type="text" name="contact_email" id="contact_email" class="form-control" value="{{$setting->contact_email}}">
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                   Update Setting
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@endsection