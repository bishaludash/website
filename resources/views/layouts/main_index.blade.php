<!doctype html>
<html lang="en"  class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="bishal udash" content="Bishal udash, Backend developer.">
    <title> @yield('title')</title>
    
    <!-- Bootstrap core CSS -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href={{ asset('css/blog.css') }} rel="stylesheet">
    @yield('blog-css')
</head>



<body>
    @yield('blog_head')
    {{-- Contains headr, navbar, featured --}}
    
    @yield('posts')
    {{-- Contains the body --}}
    
    <footer class="blog-footer">
        <p>Built with <i class="ion-heart" style="color:#f95959"></i> by <a href="{{route('home')}}">@budash</a>.
        </p>
    </footer>
    @yield('footer-js')
    {{-- for replacing upload file style --}}
    <script>
    (function (e, t, n) { 
        var r = e.querySelectorAll("html")[0]; 
        r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2") }
    )(document, window, 0);
    </script>
</body>
</html>
