<style>
    
    .section{
        margin: 10px 0;
    }
    
    .section-header{
        font-size: 1.5em;
        font-weight: 600;
        line-height: 2;
    }
    
    .section-header::after {
        content: " ";
        display: block;
        height: 3px;
        background: #9ab4ca;
    }
    
    .user_image{
        width: 100%;
        height: auto;
    }
    
    .contact{
        list-style: none;
        padding: 0;
    }
    
    .icon{
        margin-right: 10px;
        vertical-align: middle;
    }
    
    .info{
        display: flex;
    }
    
    /* school and jobs */
    .school, .job{
        margin-bottom: 25px;
        padding-bottom: 10px;
    }
    .school-info, .job-info{
        font-weight: bold;
        flex:4;
        width: 80%;
        text-transform:capitalize
    }
    .school-year, .job-year{
        float: right;
        flex: 1;
    }
    .info-secondary{
        margin-bottom: 10px;
    }
    
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<div class="section">
    {{-- {{dd($resume)}} --}}
    {{-- avatar section --}}
    @if (!is_null($resume['avatar']) && $resume['avatar'] != "")
    <div style="float: left; width: 20%;margin-right: 30px;">
        <img src="{{asset($resume['avatar'])}}" class="user_image" alt="">
    </div>
    @endif
    
    
    {{-- contact--}}
    <div style="float: left; width:40%;">
        <ul class="contact">
            
            <li>{{ sprintf("%s %s", $resume['first_name'], $resume['last_name'])  }}</li>
            <li>{{$resume['email']}}</li>
            <li>{{$resume['phone']}}</li>
            <li style="text-transform: capitalize">{{ sprintf("%s %s", $resume['state_province'] ?? null, $resume['city']?", ".$resume['city'] : null) }}</li>
            <li>{{$resume['social'] ?? null}} </li>
        </ul>
    </div>
    
    {{-- social --}}
    <div style="float: left; width:40%;">
        
    </div>
    <br style="clear: left;" />
    
    <div class="summary-wrapper">
        <p class="section-header">Career Summary</p>
        <div></div>
        {!! $resume['user_summary'] !!}
    </div>
</div>

{{-- School --}}
<div class="section">
    <p class="section-header">Education</p>        
    @foreach ($resume['school'] as $school)
    {{-- {{dd($school)}} --}}
    <div class="school">
        <div class="info">
            <div class="school-info">{{ sprintf("%s ( %s )", $school['school_name'], $school['school_location'])  }}</div>
            <div class="school-year">{{sprintf("%s - %s", $school['edu_start_year'], $school['edu_end_year'])}}</div>
        </div>
        <div class="info-secondary">
            <span >{{ sprintf("%s, %s", $school['degree'], $school['field_of_study'])  }}</span>
        </div>
        <div class="achievements">
            {!!$school['achievements']!!}
        </div>
    </div> 
    @endforeach
    
</div>

{{-- Experience --}}
<div class="section">
    <p class="section-header">Experience</p>
    
    @foreach ($resume['jobs'] as $job)
    {{-- {{dd($job)}} --}}
    <div class="job">
        <div class="info">
            <div class="job-info">{{ sprintf("%s ( %s )", $job['job_employer'], $job['job_city']) }}</div>
            <div class="job-year">
                {{sprintf("%s - %s", 
                date('M Y', strtotime($job['job_start_date'])),
                $job['job_end_date']== ("" || null)? 'Present' : date('M Y', strtotime($job['job_end_date'])))}}
            </div>
        </div>
        <div class="info-secondary">
            <span>{{ $job['job_title']}} </span>
        </div>
        <div class="achievements">
            {!! $job['job_details']!!}
        </div>
    </div>
    @endforeach
    
</div>

{{-- Skills and hobby --}}
<div class="section">
    <p class="section-header">Skills</p>
    <div class="skills">
        {!!$resume['skills']!!}
    </div>
    
</div>

{{-- Extra --}}
<div class="section"></div>