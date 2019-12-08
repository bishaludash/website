@extends('backend.layouts.main')

@section('title')
    Post
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
                                <h3>{{ucwords($post->post_title)}}</h3>
                                <p>{{$post->category->cat_name}}  {{$post->created_at->format('Y-m-d')}}</p>
                                @if ($post->is_featured)
                                    <div class="btn btn-info btn-sm">Featured</div>
                                @endif
                                @if ($post->is_pinned)
                                    <div class="btn btn-info btn-sm">Pinned</div>
                                @endif

                                {{-- Archive / unarchive--}}
                                @php
                                    $status = "archive";
                                    if($post->archive){
                                        $status ="unarchive";
                                    }
                                @endphp
                                <a class="btn btn-sm btn-danger ajax-modal" style="float: none;" data-title="{{ucwords($status)}}" 
                                    data-url="{{ route('posts.archive', [$post->id, $status]) }}">
                                    <div class="text-white">{{ucwords($status)}}</div> 
                                </a>
                                
                                <span>
                                    <a href="{{route('posts.edit', $post->id)}}">
                                        Edit
                                    </a>
                                </span>    
                                <span>
                                    <a class="btn btn-sm btn-danger ajax-modal" style="float: none;" data-title="Delete" 
                                    data-url="{{ route('posts.delete', $post->id) }}">
                                            <div class="text-white">Delete</div> 
                                    </a>
                                </span> 
                                {{-- <img src="{{asset($post->image_path)}}" alt="No Image"> --}}
                                {!! substr($post->post_body,0,200) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection