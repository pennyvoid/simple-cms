@extends('layouts.frontend')
@section('content')
    <!-- Stunning Header -->

<div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
    <h1 class="stunning-header-title">Search Result: {{ $query }}</h1>
    </div>
</div>

<!-- Post Details -->

<div class="container">
    <div class="row medium-padding120">
        <main class="main">
            
            <div class="row">
                @if ($posts->count()>0)
                    
                <div class="case-item-wrap">
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="case-item">
                            <div class="case-item__thumb">
                                <img src="{{asset("storage/$post->featured")}}" alt="our case">
                            </div>
                            <h6 class="case-item__title"><a href="{{route('single',['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <h1 class="heading-title text-center"> No Post Found</h1>
                @endif
            </div>
            <div class="text-center"></div>
            {{$posts->appends(['search'=>request()->query('search')])->links()}}
            
            <!-- End Post Details -->
            <br>
            <br>
            <br>
            <!-- Sidebar-->

            <div class="col-lg-12">
                <aside aria-label="sidebar" class="sidebar sidebar-right">
                    <div  class="widget w-tags">
                        <div class="heading text-center">
                            <h4 class="heading-title">ALL BLOG TAGS</h4>
                            <div class="heading-line">
                                <span class="short-line"></span>
                                <span class="long-line"></span>
                            </div>
                        </div>

                        <div class="tags-wrap">
                            @foreach ($tags as $tag)
                            <a href="{{route('tag.single',['id'=>$tag->id])}}" class="w-tags-item ">{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>

            <!-- End Sidebar-->

        </main>
    </div>
</div>

@endsection