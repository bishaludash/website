@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Project
@endsection

{{-- PAGE HEADING --}}
@section('page-head')
<a class="navbar-brand" href="{{route('projects.index')}}">Project | Edit </a> 
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-h">
            <div class="card-body">
            {{Form::model($project, ['method'=>'patch', 'action'=>['BE\ProjectsController@update', $project->id], 'files'=>true])}}
            
            @include('backend.projects.form')

            <div class="font-weight-bold">Files</div>
            <table>
                @foreach ($files as $file)
                <tr>
                    <td class="pr-5">                        
                        <div class="project-img-wrapper">
                            <img src="{{url('storage/'.$file['image_path'])}}" alt="not found" class="img-fluid">
                        </div>
                    </td>
                    <td>
                        {{-- TODO: File delete, show --}}
                        <a class="btn btn-sm btn-danger text-white ajax-modal" style="float: none;" data-title="Delete" 
                        data-url="{{ route('file.delete',  $file['id']) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
            
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