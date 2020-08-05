@extends('fe.home.homelayout')
@section('css')
<style>
    .project-wrapper{
        ;
    }
    .p_image_wrapper{
        display: flex;
    }
    
    .p-images{
        max-height: 150px;
        overflow: hidden;
        margin-right: 2%;
    }
    
    /* Style the Image Used to Trigger the Modal */
    .myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    
    .myImg:hover {opacity: 0.7;}
    
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }
    
    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 70%;
    }
    
    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }
    
    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }
    
    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }
    
    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }
    
    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
    
    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>
@endsection

@section('home_content')

<h2 class="mt-4 mb-3 border-bottom">Projects</h2>
@foreach ($projects as $item)
<div class="project-wrapper mb-5 ">
    
    <h4>
        @if (!is_null($item['project_url']) || $item['project_url'] !="")
        <a href="{{$item['project_url']}}" class="text-white mr-2 text-capitalize " target="_blank">
            {{$item['project_title']}}
            <i class="ion-earth ml-2"></i>
        </a>
        @else
        {{$item['project_title']}}
        @endif
    </h4>
    
    <div class="project-body">
        {!! $item['project_body']!!}
    </div>
    
    <div class="p_image_wrapper">
        @foreach ($item['images'] as $key => $image)
        <div class="w-25 p-images">
            <!-- Trigger the Modal -->
            <img src="{{asset('storage/'.$image)}}" class="img-fluid myImg" alt="" 
            onclick="testFunc('{{asset('storage/'.$image)}}')">    
        </div>        
        @endforeach
    </div>
    
</div>

@endforeach


<!-- The Modal -->
<div id="myModal" class="modal">
    
    <!-- The Close Button -->
    <span class="close">&times;</span>
    
    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">
    
    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>

@section('js')
<script>
    var modal = document.getElementById("myModal");
    
    
    
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    // var img = document.getElementsByClassName("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    
    function testFunc(path){
        var img = path;
        modal.style.display = "block";
        modalImg.src = img;
        // captionText.innerHTML = this.alt;
        
    }
    // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        </script>
        @endsection
        {{-- End JS Section --}}
        
        @endsection
        
        