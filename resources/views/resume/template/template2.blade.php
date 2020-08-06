<style>
    .intro-wrapper, .details-wrapper{
        display: flex;
    }
    
    .dp-wrapper, .details-small{
        flex: 2.3;
    }
    
    .summary, .details-large{
        flex: 6;
    }
    
    .dp-wrapper{
        /* width: 200px; */
        height: auto;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: 1%;
    }

    .summary, .details-small{
        background-color: #e3e3e3;
    }

    .user-name{
        color: #fff;
        padding: 8px 15px;
        word-spacing: 2px;
        letter-spacing: 1.5px;
    }

    .list-item{
        line-height: 1;
    }
    
</style>

{{-- html --}}
{{-- {{dd($resume)}} --}}
<div class="intro-wrapper">
    <div class="dp-wrapper" style="background: url({{asset($resume['avatar'])}}); 
    background-position: center; 
    background-size: cover;
    background-repeat: no-repeat; ">
    {{-- <img src="{{asset($resume['avatar'])}}" class="img-fluid" alt=""> --}}
</div>
<div class="summary">
    <p class="px-5 pt-5">
       {{$resume['user_summary']}}
    </p>
</div>
</div>

{{-- Name --}}
<div class="user-name bg-dark">
    <h3>
        {{sprintf("%s %s", $resume['first_name'], $resume['last_name'])}}
    </h3>
</div>

<div class="details-wrapper border">
    <div class="details-small">
        <ul class="contact list-unstyled m-4">
            <li class="pb-3 list-item"><strong>Phone :</strong>  <br>
                {{$resume['phone']}}
            </li>

            <li class="pb-3 list-item"><strong>Email :</strong>  <br>
                {{$resume['email']}}
            </li>

            <li class="pb-3 list-item"><strong>Address :</strong>  <br>
                {{$resume['city']}}<br>
                {{$resume['state_province']}}
            </li>

            <li class="pb-3 list-item"><strong>Social :</strong>  <br>
                link
            </li>
        </ul>
        
        <ul class="skills list-unstyled m-4">
            <strong>Skills</strong> <br>
            {!! $resume['skills']!!}
        </ul>
    </div>
    <div class="details-large">
        <div class="mx-5 my-4">
            <strong>Experience</strong>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
        </div>
        
        <hr>
        
        <div class="mx-5 my-4">
            <strong>Education</strong>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate mollitia quibusdam nam tenetur cumque provident quaerat excepturi nostrum, natus doloremque!</li>
            
        </div>
    </div>
</div>