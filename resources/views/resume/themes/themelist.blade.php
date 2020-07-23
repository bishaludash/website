
<div class="container">
    <div class="row">
        @foreach ($themes as $item)
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab nostrum dicta quis repellendus quisquam recusandae velit eum odio ipsam nulla.
                    
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat perferendis soluta saepe excepturi similique obcaecati fugit omnis necessitatibus, cumque tempore.
                    </p>
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


        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <p>Comming soon</p>
                </div>
                <a href="#" class="btn btn-info disabled">{{$uuid?'Select Theme' : 'Preview Theme' }}</a>
            </div>
        </div> 
    </div>
</div>