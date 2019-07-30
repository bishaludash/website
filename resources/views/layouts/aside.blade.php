<aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">{{$aboutUser->about}}</p>
    </div>
    
    <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            @foreach ($archives as $archive)
        <li><a href="{{route('blog.archive',[$archive['month'], $archive['year']])}}">
                {{$archive['month'].' '. $archive['year']}}
            </a></li>
            @endforeach
        </ol>
    </div>
    
    <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="{{$aboutUser->git_url}}" target="_blank">GitHub</a></li>
            {{-- <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li> --}}
        </ol>
    </div>
</aside><!-- /.blog-sidebar -->