<div class="card my-5 shadow">
    <div class="card-body resume-section" data-toggle="collapse" data-target="#collapse-skills" >
        <div class="text-danger display-5" >
            Skill
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Next, let’s take care of your skills.</div>
    </div>
    <div id="collapse-skills" class="collapse show">	
        <div class="card-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('skills', 'Skills')!!}
                        {!! Form::textarea('skills', null,['class'=>'form-control tiny_mce']) !!}
                    </div>
                    <span class="bg-danger btn-sm text-white d-none validation_error skills"></span>
                </div>
            </div>
        </div>
    </div>
</div>