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
        
        .img-block{
            width: 100%;
            overflow: hidden;
        }
        
        .about-image{
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
            float: right;
        }
        
        .readmore-btn:hover{
            box-shadow: 2px 2px #000;
        }
    </style>
</head>
<body class="mt-4">
    <div class="container full-height">
        {{-- Back button --}}
        <div class="row mb-3">
            <a class="readmore-btn text-white font-weight-bold" href="{{route('home')}}">
                <i class="ion-arrow-return-left"></i>  Back
            </a>
        </div>
        
        {{-- Basic Info --}}
        <div class="row mb-4">            
            <div class="col-md-4">
                <ul class="list-unstyled">
                    <li>{{$result['about']}}</li>
                    <hr>
                    <li><i class="ion-android-mail mr-2"></i> {{$result['email']}}</li>
                    <li><i class="ion-social-github mr-2"></i>
                        <a href="{{$result['git_url']}}" class="text-white">{{$result['git_url']}}</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 text-center">
                <div class="img-block">
                    <img src="https://i.pravatar.cc/200" alt="" class="img-fluid about-image">
                </div>
            </div>
        </div>
        
        {{-- Experience --}}
        <h3>Experience</h3>
        <div class="row mb-4">
            <div class="col-lg-8">
                {!! $result['experience'] !!}
            </div>
        </div>
        
    </div>
</body>
</html>
