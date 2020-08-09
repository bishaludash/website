<style>    

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
    
    
    .resume-img, .details-small{
        padding: 1%;
        width: 25%;
        float: left;
    }
    
    .user_image{
        width: 100%;
        height: auto;
    }
    
    .resume-user-name{
        background: #353332;
        color: #fff;
        padding: 10px;
        font-size: 1.5rem;
        letter-spacing: 1.5px;
    }
    
    .contact{
        list-style: none;
        padding: 0;
    }
    
    .info{
        display: flex;
    }
    
    /* school and jobs */
    .school, .job{
        margin-bottom: 25px;
        padding: 10px;
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

{{-- Avatar and summary --}}
<div class="section" style="background: #e3e3e3; margin-bottom:0" >
    {{-- avatar section --}}
    @if (!is_null($resume['avatar']) && $resume['avatar'] != "")
    <div class="resume-img">
        <img src="{{asset($resume['avatar'])}}" class="user_image" alt="">
    </div>
    @endif
    
    {{-- summary --}}
    <div style="float: left; width:70%; padding:1% 3%;">
        {!! $resume['user_summary'] !!}
    </div>
    
    <br style="clear: left;" />
</div>


{{-- Resume user name --}}
<div class="resume-user-name">
    {{ sprintf("%s %s", $resume['first_name'], $resume['last_name'])  }}
</div>


{{-- Contact and skills --}}
<div class="section">
    {{-- Contact --}}
    <div class="details-small">
        <ul style="list-style:none; padding:0">
            <li style="line-height: 1; margin-bottom: 10px;">
                <strong>Phone : </strong>  <br>
                {{$resume['phone']}}
            </li>
            <li style="line-height: 1; margin-bottom: 10px;">
                <strong>Email : </strong>  <br>
                {{$resume['email']}}
            </li>
            <li style="line-height: 1; margin-bottom: 10px; text-transform:capitalize">
                <strong>Location : </strong>  <br>
                {{ sprintf("%s %s", $resume['state_province'] ?? null, $resume['city']?", ".$resume['city'] : null) }}
            </li>
            @if (!is_null($resume['social'] || $resume['social'] != ""))
            <li style="line-height: 1; margin-bottom: 10px;">
                <strong>Social : </strong>  <br>
                {{$resume['social']}}
            </li>
            @endif
            
        </ul>
    </div>
    
    
    {{-- Skills --}}
    <div style="float: left; width:70%; padding:1% 3%;">
        {{-- Skills and hobby --}}
        <strong>Skills</strong>
        <div class="skills">
            {!!$resume['skills']!!}
        </div>
        
    </div>
    
    <br style="clear: left;" />
</div>


{{-- Education --}}
<div class="section">
    <p class="resume-user-name">Education</p>        
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
    <p class="resume-user-name">Experience</p>
    
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