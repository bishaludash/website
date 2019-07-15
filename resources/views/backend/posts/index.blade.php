@extends('backend.layouts.main')

@section('title')
    <title>Post</title>
@endsection

@section('page-head')
    Posts List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{route('posts.create')}}" class="btn btn-primary btn-sm">New Post</a>
            <a href="{{route('category.index')}}" class="btn btn-primary btn-sm">Category</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1>Use Datatable</h1>
                    @foreach ($posts as $post)
                        {{$loop->iteration}}
                        {{ucwords($post->post_title)}}
                        {{$post->created_at->format('Y-m-d')}}
                        Edit
                        Delete
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection