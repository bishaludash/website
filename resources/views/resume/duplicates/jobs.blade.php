<div class="row form-group ">
    <div class="col-lg-4">
        <div class="form-group mb-2">
            {!! Form::label('job[title][]', 'Job Title *') !!}
            {!! Form::text("job[title][]", $item['job_title'] ?? null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
        <span class="bg-danger btn-sm text-white d-none validation_error job_title_0"></span>
    </div>
    
    <div class="col-lg-4">
        <div class="form-group mb-2">
            {!! Form::label('job[employer][]', 'Employer *') !!}
            {!! Form::text("job[employer][]", $item['job_employer'] ?? null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
        <span class="bg-danger btn-sm text-white d-none validation_error job_employer_0"></span>
    </div>
    
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('job[city][]', 'City') !!}
            {!! Form::text('job[city][]', $item['job_city'] ?? null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
    </div>
    
</div>

<div class="row form-group ">
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('job[start_date][]', 'Start Date') !!}
            {!! Form::date('job[start_date][]',$item['job_start_date'] ??  null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('job[end_date][]', 'End Date') !!}
            {!! Form::date('job[end_date][]',$item['job_end_date'] ?? null, ['class'=>'form-control', 'autocomplete'=>'off', 'disabled'=>false]) !!}
        </div>
        
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="endDateCheck{{$item['id']}}">
            <label class="custom-control-label" for="endDateCheck{{$item['id']}}">I am currently working in this role</label>
        </div>
        
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('job[job_details][]', 'Job Details')!!}
            {!! Form::textarea('job[job_details][]',$item['job_details'] ?? null,['class'=>'form-control tiny_mce']) !!}
        </div>
        
    </div>
    {!! Form::number('job[id][]', $item['id'] ?? null, ['class'=>'form-control d-none item_id', 'autocomplete'=>'off']) !!}    
</div>
