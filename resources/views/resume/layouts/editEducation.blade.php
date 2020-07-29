<div class="card my-5 shadow">
    <div class="card-body resume-section" data-toggle="collapse" data-target="#collapse-education" >
        <div class="text-danger display-5" >
            Education
            <span class="float-right"><i class="ion-minus-circled"></i></span>
        </div>
        <div class="text-danger">Great, let’s work on your education. (Place your latest education at <strong>first</strong>)</div>
    </div>
    <div id="collapse-education" class="collapse show">	
        <div class="card-body">
            {{-- {{dd($resume['school'])}} --}}
            @foreach ($resume['school'] as $key=>$item)
            @if ($key == 0)
            <div class="form-group education-block">
                @include('resume.duplicates.school')
            </div>
            @endif
            
            @endforeach
            
            
            {{-- Additional Education block will be appended here. --}}
            <div class="append-education">
                @foreach ($resume['school'] as $key=>$item)
                @if ($key > 0)
                <div class='seperator-style my-4 sep-edu-{{$item['id']}}'></div>
                
                <span class='btn btn-danger btn-sm mb-4 delModal' data-toggle="modal" 
                data-target="#exampleModal" data-backdrop="static" data-keyboard="false"
                data-title="Delete School" data-displayname = '{{$item['school_name']}}'
                data-url = {{route('resume.softDelete', 
                ['uuid'=>$uuid, 'type'=>'edu-'.$item['id'], ])}}>
                Delete this block </span>
                
                <div class='edu-{{$item['id']}}'>
                    @include('resume.duplicates.school')
                </div>
                @endif
                
                @endforeach
            </div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn btn-outline-primary w-100 add-education">Add Education</div>
                </div>
            </div>
            
        </div>
    </div>
</div>