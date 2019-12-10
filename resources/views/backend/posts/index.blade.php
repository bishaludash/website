@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Post
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
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
            <div class="card-body table-responsive">
                {{-- Data table --}}
                
                <div style="overflow-x:auto;">
                    <table class="table table-bordered table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th class="border">Title</th>
                                <th class="border">Created Date</th>
                                <th class="border">Status</th>
                                <th class="border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    {{-- title --}}
                                    <td><a href="{{route('post.show', $post['id'])}}" style="color:inherit" class="datatable-links">
                                        {{ucwords($post['post_title'])}}
                                    </a></td>
                                    <td>{{$post->created_at->format('Y-m-d')}}</td>
                                    
                                    {{-- status --}}
                                    <td>
                                        {!!$post->is_featured ? "<span class='btn btn-success btn-sm'>Featured</span>" : "" !!}
                                        {!! $post->is_pinned ? "<span class='btn btn-success btn-sm'>Pinned</span>" : "" !!}
                                    </td>
                                    
                                    {{-- Actions --}}
                                    <td>
                                        @php
                                        $status = $post->archive ? "unarchive" : "archive"
                                        @endphp
                                        <a class="btn btn-sm btn-warning ajax-modal text-white" data-title="{{ucwords($status)}}" 
                                        data-url="{{ route('posts.archive', [$post->id, $status]) }}">
                                        {{ucwords($status)}}</a>
                            
                                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    
                                        <a class="btn btn-sm btn-danger text-white ajax-modal" style="float: none;" data-title="Delete" 
                                        data-url="{{ route('posts.delete', $post->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.blog-main -->
        </div>
    </div>
</div>
@endsection

@section('footer-js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection