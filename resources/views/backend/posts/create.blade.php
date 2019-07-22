@extends('backend.layouts.main')

@section('title')
    <title>Add Post</title>
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
                {{-- title --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('post_title', null, ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('post_title', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            @if ($errors->has('post_title'))
                                <span class="text-danger">{{$errors->first('post_title')}}</span> 
                            @endif
                        </div>
                    </div>
                </div>

                {{-- category --}}
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('category_id', null, ['class'=>'font-weight-bold']) !!}
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('category_id',$categories,null,['class'=>'form-control', 'placeholder'=>'Choose one']) !!}
                                @if ($errors->has('category_id'))
                                    <span class="text-danger">{{$errors->first('category_id')}}</span> 
                                @endif
                            </div>
                        </div>
                    </div>

                {{-- image --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('post_image', 'Image', ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::file('post_image', ['class'=>'btn btn-secondary']) !!}
                        </div>
                    </div>
                </div>
                
                {{--body--}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('post_body', 'Body', ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::textarea('post_body', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            @if ($errors->has('post_body'))
                                <span class="text-danger">{{$errors->first('post_body')}}</span> 
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Tags --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('tag_name', 'Tag', ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('tag_name', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                </div>

                {{-- is_featured --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('is_featured', null, ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::select('is_featured', ['0'=>'No', '1'=>'Yes'], ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

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