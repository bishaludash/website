<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000" />
    <meta name="description" content="I'm a full-stack web developer with a passion for building beautiful things from scratch. I've been building websites and sass apps since 2017 and also have a Bachelor's degree in Computer Science. Bishal Udash Keggs budash">
    <title>Bishal Udash</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #000;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        
        .full-height {
            height: 90vh;
        }

        .about-img-block{
            width: 200px;
            height: 200px;
            background: url('storage/budash.jpg') #888888;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 50%;
        }
        
        .readmore-btn{
            color: #fff;
            border: 1px solid white;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0 4px;
            box-shadow: 2px 2px #888888;
            transition: 0.3s;
        }
        
        .readmore-btn:hover{
            box-shadow: 2px 2px #000;
        }
    </style>
    @yield('css')
</head>
<body class="mt-5">
    <div class="container full-height">
        {{-- Back button --}}
        <div class="row mb-3">
            <div class="col-md-2">
                <a class="readmore-btn text-white font-weight-bold" href="{{route('home')}}">
                    <i class="ion-arrow-return-left"></i>  Back
                </a>
            </div>
            
        </div>
        
        @yield('home_content')
    </div>
    @yield('js')
</body>
</html>
