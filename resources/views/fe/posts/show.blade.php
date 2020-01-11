@extends('layouts.main_index')

@section('title')
    {{ucwords($post['post_title'])}}
@endsection

@section('blog-css')
<link rel="stylesheet" href="{{asset('css/prism.css')}}">

@endsection

@section('blog_head')
    <div class="container">
        {{-- HEADER --}}
        @include('layouts.blog_header')
    </div>
@endsection


@section('posts')
    <div class="container shadow-lg p-3 bg-white rounded ">
        <div class="row my-4 min-view-height">
            <div class="col-md-12 ">
            
            <div style="margin:1% 5%">
                <h2 class="mb-3 text-capitalize">{{$post['post_title']}}</h2>
                <span class="cat_post">{{$post['cat_name']}}</span>
                <span class="ml-4">{{ date('M d ,Y',strtotime($post['created_at'])) }}</span>
                <hr class="py-2">
            </div>
            

            <div class="text-center">
                @if (isset($post['image_path']))
                <img src="{{url('storage/'.$post['image_path'])}}" alt="{{$post['post_title']}}" class="img-fluid border" width="80%">
                @endif  
            </div>
            <div class="text-justify" style="margin: 2% 3%">
                {!! $post['post_body'] !!}
            </div>
            
            </div>
        </div>
    </div>    
@endsection

@section('footer-js')
<script src="{{asset('js/prism.js')}}"></script>
@endsection