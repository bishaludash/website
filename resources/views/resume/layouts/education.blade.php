<div class="card my-5 shadow">
    <div class="card-body resume-section bg-resume-section" data-toggle="collapse" data-target="#collapse-education" >
        <div class="text-danger display-5" >
            Education
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Great, let’s work on your education</div>
    </div>
    <div id="collapse-education" class="collapse show">	
        <div class="card-body">
            <div class="form-group education-block">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('education[school_name][]', 'School Name') !!}
                            {!! Form::text('education[school_name][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                        
                    </div>	
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('education[school_location][]', 'School Location') !!}
                            {!! Form::text('education[school_location][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>								
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('education[degree][]', 'Degree') !!}
                            {!! Form::text('education[degree][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('education[field_of_stydy][]', 'Field of Study') !!}
                            {!! Form::text('education[field_of_stydy][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group disabled">
                            {!! Form::label('education[start_year][]', 'Start Year') !!}
                            {!! Form::date('education[start_year][]', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group disabled">
                            {!! Form::label('education[end_year][]', 'End Year') !!}
                            {!! Form::date('education[end_year][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'disabled'=>true]) !!}
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked=true>
                            <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="append-education"></div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn btn-outline-primary w-100 add-education">Add Education</div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>