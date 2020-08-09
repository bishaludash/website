{{-- {{dd($themes)}} --}}
<div class="container">
    <div class="row">
        @foreach ($themes as $item)
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body" style="max-height: 280px;"> 
                    <img src="{{asset('storage/'.$item.'.png')}}" class= "img-fluid" alt="">
                </div>

                {{-- Select theme button based on uuid --}}
                @if (!is_null($uuid))
                <a href="{{route('pick.theme', ['theme'=>$item, 'uuid'=>$uuid])}}" class="btn btn-info">
                    Select Theme
                </a>
                @else
                <a href="{{route('pick.theme', ['theme'=>$item])}}" class="btn btn-info">Preview Theme</a>
                @endif
            </div>
        </div>  
        @endforeach  


        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <p>Comming soon</p>
                </div>
                <a href="#" class="btn btn-info disabled">{{$uuid?'Select Theme' : 'Preview Theme' }}</a>
            </div>
        </div> 
    </div>
</div>