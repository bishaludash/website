<div class="card my-5 shadow">
    <div class="card-body resume-section"  data-toggle="collapse" data-target="#collapse-work">
        <div class="text-danger display-5">
            Work Experience
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Now, let’s fill out your work history. (Place the latest work at <strong>first</strong>)</div>
    </div>
    <div id="collapse-work" class="collapse show">	
        <div class="card-body">
            <div class="jobs-block">
                <div class="row form-group ">
                    <div class="col-lg-4">
                        <div class="form-group mb-2">
                            {!! Form::label('job[title][]', 'Job Title *') !!}
                            {!! Form::text("job[title][]", null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white d-none validation_error job_title_0"></span>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group mb-2">
                            {!! Form::label('job[employer][]', 'Employer *') !!}
                            {!! Form::text("job[employer][]", null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white d-none validation_error job_employer_0"></span>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('job[city][]', 'City') !!}
                            {!! Form::text('job[city][]', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    
                </div>
                
                <div class="row form-group ">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('job[start_date][]', 'Start Date') !!}
                            {!! Form::date('job[start_date][]', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white d-none validation_error job_start_date_0"></span>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('job[end_date][]', 'End Date') !!}
                            {!! Form::date('job[end_date][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'disabled'=>false]) !!}
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="endDateCheck0">
                            <label class="custom-control-label" for="endDateCheck0">I am currently working in this role</label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('job[job_details][]', 'Job Details')!!}
                            {!! Form::textarea('job[job_details][]', null,['class'=>'form-control tiny_mce']) !!}
                        </div>
                        
                    </div>
                </div>
            </div>

            {{-- Additional Education block will be appended here. --}}
            <div class="append-jobs"></div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn btn-outline-primary w-100 add-jobs">Add another position</div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>