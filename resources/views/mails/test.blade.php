<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <style>
        .main-wrapper{
            margin: 30px;
        }
        .icon-wrapper{
            margin-bottom: 30px;
        }
        .blog-icon {
            color: #343a40;
            font-size: 1.5rem;
            font-weight: 600;
            font-family: monospace;
            padding: 5px 20px;
            background-color: gold;
            border-radius: 6px;
        }
        .user-name{
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="icon-wrapper">
            <span class="blog-icon">Budash</span>
        </div>
        
        <p> Hello <span class="user-name">{{$name}}</span>, your resume has been generated successfully. Please use the UUID below to download or edit in future.</p>

        <em>UUID</em> :  <strong>{{$uuid}}</strong>
    </div>    
</body>
</html>
