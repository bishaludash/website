<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-md-2 pt-1">
            {{-- <a class="text-muted" href="#">Subscribe</a> --}}
        </div>
        <div class="col-md-4 text-right">
            <a class="blog-header-logo text-dark " href="{{route('blog.home')}}">Keggsblog</a>
        </div>

        
        <div class="col-md-6">
            <div class="blog-search  {{Auth::check() ? 'float-left' : 'float-right'}}">
                
            {!! Form::open(['method'=>'POST', 'action'=>'FE\BlogController@searchPostView', 
            'class'=>'form-inline']) !!}
            
            {!! Form::text('search_val', null, ['class'=>'form-control nav-search-box',
            'placeholder'=>'Search..']) !!}
            {{ Form::button('<i class="ion-ios-search-strong"></i>', ['type' => 'submit', 
            'class' => 'btn btn-info nav-search-icon'] )  }}    
            {!! Form::close() !!}
                                
            </div>

            @if (Auth::check())
                <span class="ml-3 mobile-dnone">Welcome, {{ucwords(auth()->user()->fname)}}</span> 

                <a href="{{route('dashboard.home')}}" class="ml-4 nav-icons"
                data-toggle="tooltip" title="Dashboard">
                    <i class="ion-clipboard"></i>
                </a> 
                <a href="{{route('be.logout')}}" class="ml-4 mobile-dnone nav-icons" >
                    <i class="ion-log-out"></i>
                </a>   
            @endif
        </div>
    </div>
</header>