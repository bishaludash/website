@extends('fe.home.homelayout')
@section('home_content')

{{-- Basic Info --}}
<div class="row mb-4">            
    <div class="col-md-4">
        <ul class="list-unstyled">
            <li>{{$result['about']}}</li>
            <hr>
            <li><i class="ion-android-mail mr-2"></i> {{$result['email']}}</li>
            <li><i class="ion-social-github mr-2"></i>
                <a href="{{$result['git_url']}}" class="text-white">{{$result['git_url']}}</a>
            </li>
        </ul>
    </div>
    
    <div class="col-lg-3 text-center">
        <div class="about-img-block"></div>
    </div>
</div>

{{-- Experience --}}
<h3>Experience</h3>
<div class="row mb-4">
    <div class="col-lg-8">
        {!! $result['experience'] !!}
    </div>
</div>

@endsection