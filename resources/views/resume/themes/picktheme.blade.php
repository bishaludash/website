@extends('layouts.main_index')

{{-- Title --}}
@section('title')
{{env('APP_NAME')}} | Apply Theme
@endsection

@section('blog-css')
<link href={{ asset('css/resume.css') }} rel="stylesheet">
@endsection

@section('blog_head')
@include('resume.layouts.navbar')
@include('resume.layouts.alert')
@endsection

@section('posts')
<div class=" min-view-height">
    <div class="container px-5">
        <div class="row mb-3">
            @if (request()->has('uuid'))
            <div class="offset-md-9 col-md-2" style="display:flex">
                <a href='{{route('resume.edit',['theme'=>request()->uuid])}}' target="_blank" class="btn btn-info btn-sm mr-2">Edit Resume</a>
                
                <a href='{{route('resume.generate',['theme'=>$template])}}' target="_blank" class="btn btn-info btn-sm">Download Resume</a>
            </div>
            @endif
            
        </div>
        
        <div class="row mb-5 p-5 border">
            <div class="col-lg-12">
                @include($template)
            </div>
        </div>
    </div>
</div>

@endsection