@extends('layouts.main_index')

{{-- Title --}}
@section('title')
    bob   
@endsection

@section('blog_head')
    <div class="container">
        {{-- HEADER --}}
        @include('layouts.blog_header')
        
        {{-- NAVBAR --}}
        @include('layouts.navbar')
        
        {{-- Featured --}}
        @include('layouts.featured')
    </div>
@endsection

@section('posts')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    Latest
                </h3>
                
                {{-- Blog Post --}}
                @foreach ($posts as $post)
                <div class="blog-post">
                    <a href="{{route('post.show', $post->id)}}" style="color:inherit">
                        <h2 class="blog-post-title">{{ucwords($post->post_title)}}</h2>
                    </a>
                    <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by 
                        <a href="#">{{auth()->user()->fname}}</a>
                    </p>
                    <img src="{{asset($post->image_path)}}" class="img-fluid py-3" alt="post image">
                    {!! strip_tags(substr($post->post_body,0,300)).'...' !!}
                    
                    <div>
                        <a href="" class="btn btn-sm btn-outline-danger">Read more</a>
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
            @include('layouts.aside')
        </div><!-- /.row --> 
    </main><!-- /.container -->
    
    
@endsection