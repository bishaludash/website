<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-md-2 pt-1">
            {{-- <a class="text-muted" href="#">Subscribe</a> --}}
        </div>
        <div class="col-md-4 text-center">
            <a class="blog-header-logo text-dark " href="{{route('blog.home')}}">Keggsblog</a>
        </div>

        
        <div class="col-md-6">
        <div class="blog-search  {{Auth::check() ? 'float-left' : 'float-right'}}">
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control">
                    <div class="input-group-prepend">
                        <a href=# class="input-group-text">
                                <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>                
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