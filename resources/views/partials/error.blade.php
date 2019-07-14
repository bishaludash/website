@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style:none; padding-left:0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif