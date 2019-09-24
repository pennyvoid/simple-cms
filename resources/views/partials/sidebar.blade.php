@auth
<div class="col-lg-4">
    <ul class="list-group">
        <a href="{{route('dashboard')}}" class="list-group-item" style="text-decoration:none">Home</a>
        @if (auth()->user()->isAdmin())
        <a href="{{route('users')}}" class="list-group-item" style="text-decoration:none">Users</a>
        @endif
        <a href="{{route('categories')}}" class="list-group-item" style="text-decoration:none">Categories</a>
        <a href="{{route('tags.index')}}" class="list-group-item" style="text-decoration:none">Tags</a>
        <a href="{{route('posts')}}" class="list-group-item" style="text-decoration:none">Posts</a>
        <a href="{{route('trashed.posts')}}" class="list-group-item" style="text-decoration:none">Trashed Posts</a>
        <a href="{{route('settings.edit')}}" class="list-group-item" style="text-decoration:none">Settings</a>
    </ul>
</div>
@endauth