@if (session()->has('message'))
    <div class="alert alert-info alert-dismissible fade show">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ion-close-circled small"></i>
        </button>
        <span>
            <b> Info - </b> {{session()->get('message')}}
        </span>
    </div>
@endif


@if (session()->has('message_success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ion-close-circled small"></i>
        </button>
        <span>
            <b> Success - </b> {{session()->get('message_success')}}
        </span>
    </div>
@endif


@if (session()->has('message_danger'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ion-close-circled small"></i>
        </button>
        <span>
            <b> Error - </b> {{session()->get('message_danger')}}
        </span>
    </div>
@endif