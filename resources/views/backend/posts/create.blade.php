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

        @include('partials.flash')

        <div class="card" style="min-height:80vh">
            <div class="card-body pt-4">
                {!! Form::open(['method'=>'POST', 'action'=>'BE\PostController@store']) !!}
                {{-- title --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('post_title', null, ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('post_title', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                </div>

                {{-- category --}}
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                {!! Form::label('category_id', null, ['class'=>'font-weight-bold']) !!}
                            </div>
                            <div class="col-md-10">
                                {!! Form::select('category_id', [''=>'Select Category','1'=>'Option1', '2'=>'Option2'], ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>

                {{-- image --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('file', 'Image', ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::file('post-image', ['class'=>'btn btn-secondary']) !!}
                        </div>
                    </div>
                </div>
                
                {{--about--}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('post_body', 'Body', ['class'=>'font-weight-bold']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::textarea('post_body', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
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
                            {!! Form::select('is_featured', ['0'=>'No', '1'=>'Yes'], ['class'=>'form-control', 'autocomplete'=>'off']) !!}
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