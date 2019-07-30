{!! Form::open(['method'=>'POST', 'action'=>['BE\PostController@archivePost', $post->id, $archive]]) !!}
    @if ($archive == 'archive')
        {{--archive--}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <p>Are you sure you want to archive ?</p> 
                    <span class="font-weight-bold mt-3">{{substr($post->post_title,0,105)}}</span>
                </div>
            </div>
        </div>
    @elseif( $archive == 'unarchive'  )
        {{--unarchive--}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <p>Are you sure you want to unarchive ?</p> 
                    <span class="font-weight-bold mt-3">{{substr($post->post_title,0,105)}}</span>
                </div>
            </div>
        </div>
    @endif
    <hr>

    <div class="ml-3">
        <div class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Cancel</span></div>
        <input class="btn btn-primary btn-sm" type="submit" value="Submit">
    </div>

{!! Form::close() !!}