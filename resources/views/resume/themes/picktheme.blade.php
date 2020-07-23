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
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                @include($template)
            </div>
        </div>

        <div class="row mb-5">
            <div class="offset-md-10 col-md-2">
            <a href='{{route('resume.generate',['theme'=>$template])}}' target="_blank" class="btn btn-primary">Download Resume</a>
            </div>
        </div>
    </div>
</div>

@endsection