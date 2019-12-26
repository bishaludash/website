@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Project
@endsection

{{-- PAGE HEADING --}}
@section('page-head')
<a class="navbar-brand" href="#pablo">Project</a>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-h">
            <div class="card-body">
             <h3>{{$project['project_title']}}</h3>            
             <p>{{$project['created_at']}}</p>            
             <p>{!! $project['project_body'] !!}</p>  
             @foreach ($project['files'] as $item)
                <div class="project-img-wrapper">
                    <img src="{{url('storage/'.$item['image_path'])}}" alt="not found" class="img-fluid">
                </div>
             @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-js')
    @include('partials.tiny-mce')
@endsection