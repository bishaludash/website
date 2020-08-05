@extends('layouts.main_index')

{{-- Title --}}
@section('title')
{{env('APP_NAME')}} | Resume Builder
@endsection

@section('blog-css')
<link href={{ asset('css/resume.css') }} rel="stylesheet">
@endsection

@section('blog_head')
@include('resume.layouts.navbar')
@include('resume.layouts.alert')
@endsection

@section('posts')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class=" min-view-height">
                <h3>Search Your Resume</h3>
                {{Form::open(['method'=>'post', 
                'route'=>'resume.get'
                ])}}
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{Form::text('resume_uuid', null, 
                            ['class'=>['form-control'], 'placeholder'=>'Resume Unique ID'])}}
                        </div>
                        <div class="small text-muted">
                            <i class="ion-information-circled ml-2"></i>
                            Resume unique id is emailed to you after building ruseme the first time.
                        </div>
                        <span class="bg-danger btn-sm text-white d-none validation_error search_status"></span>
                    </div>
                    
                    <div class="col-md-2">
                        {{Form::submit('Search', ['class'=>'btn  btn-info'])}}
                    </div>
                </div>
                
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer-js')
<script src="{{asset('admin/js/core/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/core/bootstrap.min.js')}}"></script>
<script>
     // close alert
     $(document).on('click', '.close-alert', function () {
        $(this).parent().remove();
    });
</script>
@endsection