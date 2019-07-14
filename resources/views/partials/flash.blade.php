@if (session()->has('message'))
    <div class="alert alert-primary">
        {{session()->get('message')}}
    </div>
@endif


@if (session()->has('message_success'))
    <div class="alert alert-success">
        {{session()->get('message_success')}}
    </div>
@endif