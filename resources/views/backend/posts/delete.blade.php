{!! Form::open(['method'=>'DELETE', 'action'=>['BE\PostController@destroy', $post->id]]) !!}
    <div class="form-group">
        <div class="row">
            <div class="ml-3">
                    Are you sure you want to delete ?
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="ml-3">
                <div class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">Cancel</span></div>
                {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}