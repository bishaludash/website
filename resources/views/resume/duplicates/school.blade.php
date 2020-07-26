<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-2">
            {!! Form::label('school[name][]', 'School Name *') !!}
            {!! Form::text('school[name][]', $item['school_name'] ?? null,
            ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
        <span class="bg-danger btn-sm text-white validation_error d-none school_name_0"></span>
    </div>
    <div class="col-lg-6">
        <div class="form-group mb-2">
            {!! Form::label('school[location][]', 'School Location *') !!}
            {!! Form::text('school[location][]', $item['school_location'] ?? null,
            ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
        <span class="bg-danger btn-sm text-white validation_error d-none school_location_0"></span>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-2">
            {!! Form::label('school[degree][]', 'Degree *') !!}
            {!! Form::text('school[degree][]',$item['degree'] ?? null,
            ['class'=>'form-control', 'autocomplete'=>'off',
            'placeholder'=>'Eg : Bachelors, Masters']) !!}
        </div>
        <span class="bg-danger btn-sm text-white validation_error d-none school_degree_0"></span>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('school[field_of_study][]', 'Field of Study *') !!}
            {!! Form::text('school[field_of_study][]',$item['field_of_study'] ?? null, ['class'=>'form-control', 'autocomplete'=>'off',
            'placeholder'=>'Eg : Bsc.CSIT, Civil Engineering']) !!}
        </div>
        <span class="bg-danger btn-sm text-white validation_error d-none school_field_of_study_0"></span>
    </div>

    <div class="col-lg-3">
        <div class="form-group mb-2">
            {!! Form::label('school[start_year][]', 'Start Year *') !!}
            {!! Form::month('school[start_year][]', Carbon\Carbon::parse($item['edu_start_year']) ?? null,
            ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
        <span class="bg-danger btn-sm text-white validation_error d-none school_start_year_0"></span>
    </div>

    <div class="col-lg-3">
        <div class="form-group mb-2">
            {!! Form::label('school[end_year][]', 'End Year (or expected) *') !!}
            {!! Form::month('school[end_year][]', Carbon\Carbon::parse($item['edu_end_year']) ?? null,
            ['class'=>'form-control', 'autocomplete'=>'off']) !!}
        </div>
        <span class="bg-danger btn-sm text-white validation_error d-none school_end_year_0"></span>
    </div>

    <div class="col-md-8">
        <div class="form-group ">
            {!! Form::label('school[achievements][]', 'Achievements')!!}
            {!! Form::textarea('school[achievements][]', $item['achievements'] ?? null,['class'=>'form-control tiny_mce']) !!}
        </div>
    </div>

</div>

{!! Form::number('school[school_id][]', $item['id'] ?? null, ['class'=>'form-control d-none', 'autocomplete'=>'off']) !!}