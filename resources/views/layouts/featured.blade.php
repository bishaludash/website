{{-- Featured Section --}}
<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="row">
        <div class="col-md-8 px-0">
            <a href="{{route('post.show', $featured['id'])}}" class="text-white">
                <h1 class="display-4 font-italic text-capitalize">{{$featured['post_title']}}</h1>
            </a>
            <div class="lead my-3">
                {!! strip_tags(substr($featured['post_body'],0,300)).'...' !!}
            </div>
            <p class="lead mb-0"><a href="{{route('post.show', $featured['id'])}}" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
        
        {{-- Featured image --}}
        <div class="col-md-4 px-0 featured-image">
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
                <a href="{{route('cat.show', $pinned['category_id'])}}" class="text-capitalize">
                    <strong class="d-inline-block mb-2 {{$color[$a]}}">{{$pinned['cat_name']}}</strong>
                </a>
                <a href="{{route('post.show', $pinned['id'])}}" style="color:inherit">
                    <h4 class="mb-0 text-dark text-capitalize">{{$pinned['post_title']}}</h4>
                </a>
                <div class="mb-1 text-muted">{{date('M d, Y',strtotime($pinned['updated_at']))}}</div>
                <p class="card-text mb-auto"></p>
                <a href="{{route('post.show', $pinned['id'])}}" class="stretched-link">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                @if (isset($pinned['image_path']))
                <img src="{{url('storage/'.$pinned['image_path'])}}" alt="{{$pinned['post_title']}}">
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

`
{{-- TODO  backup feat img--}}
@php
$feat_img = isset($featured['image']) ? $featured['image'] : '';
@endphp
<style>
    .featured-image{
        background-image: url({{'storage/'.$feat_img}});
        background-position: center;
        object-fit: cover;
        background-repeat: no-repeat;
        background-size: contain;
        min-height: {{ $feat_img ? '200px': '50px'}};
    }
</style>