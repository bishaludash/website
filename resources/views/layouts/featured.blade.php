{{-- Featured Section --}}


<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="row">
        <div class="col-md-8 px-0">
            <a href="{{route('post.show', $featured[0]['id'])}}" class="text-white">
                <h1 class="display-4 font-italic">{{$featured[0]['post_title']}}</h1>
            </a>
            <div class="lead my-3">
                    {!! strip_tags(substr($featured[0]['post_body'],0,300)).'...' !!}
            </div>
        <p class="lead mb-0"><a href="{{route('post.show', $featured[0]['id'])}}" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>

        <div class="col-md-4 px-0 featured-image">
            {{-- <img src="{{asset($featured->image_path)}}" class="img-fluid" alt=""> --}}
        </div>
    </div>
</div>


<div class="row mb-2">
    @php
        $color = ['text-primary', 'text-success', 'text-danger'];
    @endphp
    
    {{-- Pinned Section --}}
    @foreach ($pinned_posts as $pinned)
        {{-- random color --}}
        @php
            $a = mt_rand(0, 2); 
        @endphp
        
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <a href="#"><strong class="d-inline-block mb-2 {{$color[$a]}}">
                    {{$pinned->category->cat_name}}</strong></a>
                    <h4 class="mb-0">{{$pinned->post_title}}</h4>
                    <div class="mb-1 text-muted">{{$pinned->updated_at->format('M d')}}</div>
                    <p class="card-text mb-auto"></p>
                    <a href="{{route('post.show', $pinned->id)}}" class="stretched-link">Continue reading</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                </div>
            </div>
        </div>
    @endforeach
</div>


{{-- TODO  backup feat img--}}
@php
    $feat_img = asset($featured[0]['image_path']) ?? ''
@endphp
<style>
.featured-image{
    background-image: url({{$feat_img}});
    background-position: center;
    object-fit: cover;
    background-repeat: no-repeat;
    background-size: contain;
}
</style>