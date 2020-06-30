<div class="card my-5 shadow">
    <div class="card-body resume-section bg-resume-section"  data-toggle="collapse" data-target="#collapse-work">
        <div class="text-danger display-5">
            Work Experience
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Now, let’s fill out your work history</div>
    </div>
    <div id="collapse-work" class="collapse show">	
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('job_title', 'Job Title') !!}
                            {!! Form::text("job[title][]", null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('employer', 'Employer') !!}
                            {!! Form::text("job[employer][]", null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('job[city][]', 'City') !!}
                            {!! Form::text('job[city][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('job[start_date][]', 'Start Date') !!}
                            {!! Form::date('job[start_date][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group disabled">
                            {!! Form::label('job[end_date][]', 'End Date') !!}
                            {!! Form::date('job[end_date][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'disabled'=>false]) !!}
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked=true>
                            <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group disabled">
                            {!! Form::label('job[job_details][]', 'Job Details')!!}
                            {!! Form::textarea('job[job_details][]', null,['class'=>'form-control']) !!}
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn btn-outline-primary w-100 ">Add another position</div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>