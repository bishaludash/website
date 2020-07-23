@extends('layouts.main_index')

{{-- Title --}}
@section('title')
{{env('APP_NAME')}} | Pick themes
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
    @include('resume.themes.themelist')
</div>

@endsection