@extends('layouts.main_index')

@section('title')
{{env('APP_NAME')}} | Category
@endsection

@section('blog_head')
<div class="container">
    {{-- HEADER --}}
    @include('layouts.blog_header')
</div>
@endsection

@section('posts')
<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-4 mb-4 font-italic border-bottom">
                {{$input}}
            </h3>
            
            {{-- Blog Post --}}
            @include('fe.partials.list_posts')
                        
        </div><!-- /.blog-main -->
        
    </div><!-- /.row --> 
</main><!-- /.container -->


@endsection
