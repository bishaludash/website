<div class="card shadow">
    <div class="card-body resume-section bg-resume-section" data-toggle="collapse" data-target="#collapseOne" >
        <div class="text-danger display-5">
            Personal Info
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">What’s the best way for employers to contact you?</div>
    </div>	
    				
    <div id="collapseOne" class="collapse show ">
        <div class="card-body">
            
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            {!! Form::label('first_name', 'First Name *') !!}
                            {!! Form::text('first_name', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                        <span class="bg-danger btn-sm text-white d-none validation_error first_name">Some error</span>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name *') !!}
                            {!! Form::text('last_name', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                </div>					
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('city', 'City') !!}
                            {!! Form::text('city', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('state_province', 'State/Province') !!}
                            {!! Form::text('state_province', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('zip', 'Zip') !!}
                            {!! Form::text('zip', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone *') !!}
                            {!! Form::text('phone', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('email', 'Email *') !!}
                            {!! Form::email('email', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>