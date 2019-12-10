@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Post
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
                <div class="card">
                    <div class="card-body">
                        {{-- Title --}}
                        <a href="{{route('post.show', $post['id'])}}" style="color:inherit">
                            <h2 class="blog-post-title mb-1">{{ucwords($post['post_title'])}}</h2>
                        </a>
                        {{$post->created_at->format('Y-m-d')}}
                        
                        {{-- Options --}}
                        <div>
                            {!!$post->is_featured ? "<span class='btn btn-success btn-sm'>Featured</span>" : "" !!}
                            {!! $post->is_pinned ? "<span class='btn btn-success btn-sm'>Pinned</span>" : "" !!}
                            @php
                            $status = $post->archive ? "unarchive" : "archive"
                            @endphp
                            <a class="btn btn-sm btn-danger ajax-modal text-white" data-title="{{ucwords($status)}}" 
                            data-url="{{ route('posts.archive', [$post->id, $status]) }}">
                            {{ucwords($status)}}
                            </a>
                        
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-danger">Edit</a>
                            <a class="btn btn-sm btn-danger ajax-modal" style="float: none;" data-title="Delete" 
                            data-url="{{ route('posts.delete', $post->id) }}">
                            <div class="text-white">Delete</div> 
                            </a>
                        </div>      
                    </div>
                    </div> 
        
                    @endforeach
                    {{ $posts->links() }}
        
        
            </div><!-- /.blog-main -->
        </div>
    </div>
</div>
@endsection