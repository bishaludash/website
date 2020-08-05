<div class="card my-5 shadow">
    <div class="card-body resume-section" data-toggle="collapse" data-target="#collapse-summary" >
        <div class="text-danger display-5" >
            Summary
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Finally, let’s work on your summary.</div>
    </div>
    <div id="collapse-summary" class="collapse show">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
                        {!! Form::label('user_summary', 'Summary')!!}
                        {!! Form::textarea('user_summary',$resume['user_summary'] ?? null,['class'=>'form-control, tiny_mce']) !!}
                    </div>
                    <span class="bg-danger btn-sm text-white d-none validation_error user_summary"></span>
                </div>
            </div>
        </div>
    </div>
</div>