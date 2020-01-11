<aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">{{$aboutUser->about ?? ''}}</p>
    </div>
    
    <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            @foreach ($archives as $archive)
            <li>
                <a href="{{route('blog.archive',[$archive['month'], $archive['year']])}}">
                    {{ date('M', mktime(0, 0, 0,$archive['month'], 10)).' '.
                     $archive['year'].' ('.$archive['published'].')'}}
                </a>
            </li>
            @endforeach
        </ol>
    </div>
    
    <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled d-inline">
            <li style="display:inline-block">
                <a href="{{$aboutUser->git_url ?? '#'}}" target="_blank" class="blog-social-icon">
                    <i class="ion-social-github"></i>
                </a>
            </li>

            <li style="display:inline-block">
                <a href="https://www.linkedin.com/in/bishal-udash-04a07215a/" target="_blank" class="blog-social-icon">
                    <i class="ion-social-linkedin"></i>
                </a>
            </li>
            
        </ol>
    </div>
</aside><!-- /.blog-sidebar -->