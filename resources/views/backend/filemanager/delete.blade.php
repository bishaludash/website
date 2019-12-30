{!! Form::open(['method'=>'POST', 'action'=>['BE\FileController@destroy']]) !!}
<div class="form-group">
    <div class="row">
        <div class="ml-3">
            Are you sure you want to delete ?<br>
            @foreach ($files as $item)
            <li>{{$item->file_name ?? 'Invalid file name'}}</li>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-12">
            {!! Form::text('file_ids', $ids, ['class'=>'form-control d-none' ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="ml-3">
            <div class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Cancel</span>
            </div>
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}


