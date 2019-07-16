{!! Form::model($category, ['method'=>'PATCH', 'action'=>['BE\CategoryController@update', $category->id]]) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-lg-3">
                {!! Form::label('cat_name', 'Category ', ['class'=>'']) !!}
            </div>
            <div class="col-lg-9">
                {!! Form::text('cat_name', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="offset-md-3 col-lg-9">
                {!! Form::submit('Update', ['class'=>'btn btn-primary btn-sm']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}