@if(Session::has('message'))
<div class=" alert-box p-3 bg-danger text-white sticky-top mb-0 ">
    <span class="flash-message ml-5">{{session()->get('message')}}</span>
    <span class="close-alert  float-right"><i class="ion-close-circled display-5"></i></span>
</div>
@endif

<div class="alert-box p-3 bg-danger text-white sticky-top mb-0 invisible">
    <span class="flash-message ml-5"></span>
    <span class="close-alert  float-right"><i class="ion-close-circled display-5"></i></span>
</div>