{!! Form::open(['method'=>'POST', 'action'=>'BE\CategoryController@store']) !!}
<div class="form-group">
    <div class="row">
        <div class="col-lg-2">
            {!! Form::label('cat_name', 'Category : ', ['class'=>'font-weight-bold']) !!}
        </div>
        <div class="col-lg-8">
            {!! Form::text('cat_name', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
            @if ($errors->has('cat_name'))
            <span class="text-danger">{{$errors->first('cat_name')}}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="offset-md-2 col-lg-10">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}