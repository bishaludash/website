@extends('backend.layouts.main')

@section('title')
    Add Post
@endsection


@section('page-head')
    Add Post
@endsection


@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card" style="min-height:80vh">
            <div class="card-body pt-4">
                {!! Form::open(['method'=>'POST', 'action'=>'BE\PostController@store', 'files'=>true]) !!}
                
                @php
                // setting the image value to null
                    $post['image_path'] = null;
                    $post['is_pinned'] = null;
                @endphp
                @include('backend.posts.form')

                <div class="form-group">
                    <div class="row">
                        <div class="offset-md-2 col-md-10">
                            {!! Form::submit('Post', ['class'=>'btn btn-primary btn-sm']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
@endsection