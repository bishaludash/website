@extends('layouts.main_index')

@section('title')
    {{$post->post_title}}
@endsection

@section('blog_head')
    <div class="container">
        {{-- HEADER --}}
        @include('layouts.blog_header')
    </div>
@endsection


@section('posts')
    <div class="container shadow-lg p-3 bg-white rounded">
        <div class="row my-4">
            <div class="col-md-12 ">
            
            <div style="width:80%; margin:1% 10%">
                <h2 class="mb-3">{{$post->post_title}}</h2>
                <span class="cat_post">{{$post->category->cat_name}}</span>
                <span class="ml-4">{{$post->created_at->toFormattedDateString()}}</span>
                <hr class="py-2">
            </div>
            

            <div class="text-center">
                @if ($post->image_path)
                <img src="{{asset($post->image_path)}}" alt="{{$post->post_title}}" class="img-fluid border" width="80%">
                @endif  
            </div>
            <div class="text-justified" style="margin: 2% 10%">
                {{ $post->post_body }}
            </div>
            
            </div>
        </div>
    </div>    
@endsection