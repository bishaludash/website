@extends('fe.home.homelayout')
@section('home_content')

<h2 class="mt-4 mb-3 border-bottom">Projects</h2>
@foreach ($projects as $item)
    <h5>
        <a href="{{$item['project_url']}}" class="text-white mr-2 " target="_blank">
            {{$item['project_title']}}
        </a>
    </h5>

    <div class="project-body">
        {!! $item['project_body']!!}
    </div>
   
@endforeach

@endsection