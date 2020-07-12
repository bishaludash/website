<div class="card my-5 shadow">
    <div class="card-body resume-section" data-toggle="collapse" data-target="#collapse-education" >
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
                        <div class="form-group mb-2">
                            {!! Form::label('school[name][]', 'School Name *') !!}
                            {!! Form::text('school[name][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white validation_error d-none school_name_0"></span>
                    </div>	
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            {!! Form::label('school[location][]', 'School Location *') !!}
                            {!! Form::text('school[location][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white validation_error d-none school_location_0"></span>
                    </div>								
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            {!! Form::label('school[degree][]', 'Degree *') !!}
                            {!! Form::text('school[degree][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 
                            'placeholder'=>'Eg : Bachelors, Masters']) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white validation_error d-none school_degree_0"></span>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('school[field_of_study][]', 'Field of Study *') !!}
                            {!! Form::text('school[field_of_study][]', null, ['class'=>'form-control', 'autocomplete'=>'off', 
                            'placeholder'=>'Eg : Bsc.CSIT, Civil Engineering']) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white validation_error d-none school_field_of_study_0"></span>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group mb-2">
                            {!! Form::label('school[start_year][]', 'Start Year *') !!}
                            {!! Form::month('school[start_year][]', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white validation_error d-none school_start_year_0"></span>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group mb-2">
                            {!! Form::label('school[end_year][]', 'End Year (or expected) *') !!}
                            {!! Form::month('school[end_year][]', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                        </div>       
                        <span class="bg-danger btn-sm text-white validation_error d-none school_end_year_0"></span>                 
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-group ">
                            {!! Form::label('school[achievements][]', 'Achievements')!!}
                            {!! Form::textarea('school[achievements][]', null,['class'=>'form-control tiny_mce']) !!}
                        </div>
                    </div>
                    
                </div>
            </div>
            
            {{-- Additional Education block will be appended here. --}}
            <div class="append-education"></div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn btn-outline-primary w-100 add-education">Add Education</div>
                </div>
            </div>
            
        </div>
    </div>
</div>