{{-- title --}}
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('post_title', 'Post title :', ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('post_title', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
            @if ($errors->has('post_title'))
            <span class="text-danger">{{$errors->first('post_title')}}</span> 
            @endif
        </div>
    </div>
</div>

{{-- category --}}
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('category_id', 'Category :', ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-md-8">
            {!! Form::select('category_id',$categories,null,['class'=>'custom-select', 'placeholder'=>'Choose one']) !!}
            @if ($errors->has('category_id'))
            <span class="text-danger">{{$errors->first('category_id')}}</span> 
            @endif
        </div>
    </div>
</div>

{{-- image --}}
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('post_image', 'Image :', ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::file('post_image', ['class'=>'btn btn-secondary']) !!}
            
            {{-- Image --}}
            @if ($post['image_path'])
            <img src="{{asset($post->image_path)}}" alt="{{$post->post_title}}" class="img-fluid border d-block" width="100px", height="auto">
            @endif
        </div>
    </div>
</div>

{{--body--}}
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('post_body', 'Body :', ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::textarea('post_body', null, ['class'=>'form-control tiny_mce', 'autocomplete'=>'off']) !!}
            @if ($errors->has('post_body'))
            <span class="text-danger">{{$errors->first('post_body')}}</span> 
            @endif
        </div>
    </div>
</div>


{{-- is_featured --}}
<div class="form-group">
    <div class="row mt-3">
        <div class="col-md-2">
            {!! Form::label('is_featured', "Is Featured :", ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('is_featured', ['0'=>'No', '1'=>'Yes'],null, ['class'=>'custom-select']) !!}
        </div>
        
        {{-- pinned post --}}
        <div class="offset-md-1 col-md-2">
            {!! Form::label('is_pinned', 'Is Pinned :', ['class'=>'font-weight-bold float-right']) !!}
        </div>
        <div class="col-md-3">
            <label class="switch d-none">
                <input type="checkbox" name="is_pinned" checked value="0">
                <span class="slider round"></span>
            </label>
            
            <label class="switch">
                <input type="checkbox" name="is_pinned" @if ($post['is_pinned'])
                    checked
                @endif value="1">
                <span class="slider round"></span>
            </label>
        </div>
    </div>
</div>

{{-- Tags --}}
<div class="form-group">
    <div class="row mt-3">
        <div class="col-md-2">
            {!! Form::label('tag_name', 'Tag', ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('tag_name', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
    </div>
</div> 