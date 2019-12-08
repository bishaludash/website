@extends('layouts.main_index')

@section('title')
    Post | Archive posts
@endsection

@section('blog_head')
    <div class="container">
        {{-- HEADER --}}
        @include('layouts.blog_header')
        
        {{-- NAVBAR --}}
        {{-- @include('layouts.navbar') --}}
        
        {{-- Featured --}}
        {{-- @include('layouts.featured') --}}
    </div>
@endsection

@section('posts')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    Archive
                </h3>
                
                {{-- Blog Post --}}
                @foreach ($archive_posts as $post)
                <div class="blog-post">
                    <a href="{{route('post.show', $post->id)}}" style="color:inherit">
                        <h2 class="blog-post-title">{{ucwords($post->post_title)}}</h2>
                    </a>
                    <p class="blog-post-meta">{{$post->updated_at->toFormattedDateString()}} by 
                        <a href="#">{{$post->user->fname}}</a>
                    </p>
                    <img src="{{asset($post->image_path)}}" class="img-fluid py-3" alt="post image">
                    {!! strip_tags(substr($post->post_body,0,300)).'...' !!}
                    
                    <div>
                        <a href="{{route('post.show', $post->id)}}" class="btn badge-pill btn-sm btn-outline-danger mt-3">Read more</a>
                    </div>
                    
                </div><!-- /.blog-post -->
                <hr>
                @endforeach
                
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
                </nav>
                
            </div><!-- /.blog-main -->
            
            {{-- ASIDE --}}
            {{-- @include('layouts.aside') --}}
        </div><!-- /.row --> 
    </main><!-- /.container -->
    
    
@endsection