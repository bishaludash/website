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

            @foreach ($resume['jobs'] as $key=>$item)
            @if ($key == 0)
            <div class="jobs-block">
                {{-- {{dd($item)}} --}}
                @include('resume.duplicates.jobs')
            </div>
            @endif
            
            @endforeach
            

            {{-- Additional Education block will be appended here. --}}
            <div class="append-jobs">
                @foreach ($resume['jobs'] as $key=>$item)
                @if ($key > 0)
                <div class='seperator-style my-4 sep-edu-{{$item['id']}}'></div>
                
                <span class='btn btn-danger btn-sm mb-4 delModal' data-toggle="modal" 
                data-target="#exampleModal" data-backdrop="static" data-keyboard="false"
                data-title="Delete School" data-displayname = '{{$item['job_title']}}'
                data-url = {{route('resume.softDelete', 
                ['uuid'=>$uuid, 'type'=>'job-'.$item['id'], ])}}>
                Delete this block </span>
                
                <div class='edu-{{$item['id']}}'>
                    @include('resume.duplicates.jobs')
                </div>
                @endif
                
                @endforeach
            </div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn btn-outline-primary w-100 add-jobs">Add another position</div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>