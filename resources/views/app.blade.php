@extends('layouts.main_index')

{{-- Title --}}
@section('title')
{{env('APP_NAME')}} | Blog
@endsection

@section('blog_head')
<div class="container">
    {{-- HEADER --}}
    <div class="border-bottom">
    @include('layouts.blog_header')
    </div>
    
    {{-- NAVBAR --}}
    @include('layouts.navbar')
    
    {{-- Featured --}}
    @if (count($featured) > 0)
    @include('layouts.featured')
    @endif
    
</div>
@endsection

@section('posts')
<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-4 mb-4 font-italic border-bottom">
                Latest
            </h3>
            
            @include('fe.partials.list_posts')
            
        </div><!-- /.blog-main -->
        
        {{-- ASIDE --}}
        @include('fe.partials.aside')
        
    </div><!-- /.row --> 
</main><!-- /.container -->


@endsection