@extends('layouts.main_index')

@section('title')
    {{env('APP_NAME')}} | Category
@endsection

@section('blog_head')
    <div class="container">
        {{-- HEADER --}}
        @include('layouts.blog_header')
    </div>
@endsection

@section('posts')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    {{$category->cat_name}}
                </h3>
                
                {{-- Blog Post --}}
                @foreach ($cat_posts as $post)
                <div class="blog-post">
                    <a href="{{route('post.show', $post['id'])}}" style="color:inherit">
                        <h2 class="blog-post-title">
                            {{ucwords($post['post_title'])}}
                        </h2>
                    </a>
                    <p class="blog-post-meta">
                        @php
                            $date = strtotime($post['created_at']);
                        @endphp
                        
                        {{date('M d, Y', $date)}} by 
                        <a href="#">
                            {{ucwords($post['user'])}}
                        </a>
                    </p>
                    <img src="" class="img-fluid py-3" alt="post image">
                    {{-- {!! strip_tags(substr($post->post_body,0,300)).'...' !!} --}}
                    
                    <div>
                        <a href="{{route('post.show', $post['id'])}}" class="btn badge-pill btn-sm btn-outline-danger mt-3">Read more</a>
                    </div>
                    
                </div><!-- /.blog-post -->
                <hr>
                @endforeach
                
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
                </nav>
                
            </div><!-- /.blog-main -->

        </div><!-- /.row --> 
    </main><!-- /.container -->
    
    
@endsection