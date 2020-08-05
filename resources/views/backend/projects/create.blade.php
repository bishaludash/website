@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Project
@endsection

{{-- PAGE HEADING --}}
@section('page-head')
<a class="navbar-brand" href="{{route('projects.index')}}">Project | Add </a> 
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-h">
            <div class="card-body">
            {{Form::open(['method'=>'post', 'action'=>'BE\ProjectsController@store', 'files'=>true])}}
            
            @include('backend.projects.form')


            <div class="form-group">
                <div class="row">
                    <div class="col-lg-2">
                        {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
                    </div>
                </div>
            </div>
            
            
            {{Form::close()}}                
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-js')
    @include('partials.tiny-mce')
@endsection