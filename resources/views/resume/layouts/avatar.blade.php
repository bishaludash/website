<div class="card mb-5 shadow">
    <div class="card-body resume-section" data-toggle="collapse" data-target="#collapse-avatar" >
        <div class="text-danger display-5" >
            Avatar
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Upload your photo for resume.</div>
    </div>
    <div id="collapse-avatar" class="collapse show">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    {!! Form::open(['method'=>'post',
                    'route'=>'avatar.upload',
                    'id'=>'avatar-upload',
                    'files'=>true,]) !!}
                    <div class="form-group mb-2">
                        <input type="file" name="user_avatar" id="user_avatar" 
                        class="inputfile inputfile-1 avatar-file"/>
                        <label for="user_avatar">
                            <span>Choose a file <i class="ion-android-upload ml-2"></i></span>
                        </label>
                    </div>
                    {!! Form::close()!!}

                    {{-- display uploaded image --}}
                    @php
                    $avatar = $resume['avatar'] ?? null;
                    @endphp
                    <img src="{{$avatar}}" 
                    class="display-avatar img-fluid p-2 border shadow {{$avatar == null ? 'd-none' : ''}}">
                </div>
                <div class="col-lg-8">
                    <div class="mt-2">
                        <img src="{{asset('storage/ajax-loader.gif')}}" class="avatar-loader  d-none">
                        <span class="alert-danger avatar-error text-danger p-2  d-none"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




