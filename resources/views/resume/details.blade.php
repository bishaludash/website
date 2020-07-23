<div class="container">
	{{-- Banner --}}
	<div class="row border-bottom">
		<div class="col-md-6">
			<h1 class="mb-5 display-4" >
				Easy and Free Online Resume Builder
			</h1>
			
			<p>Get what you need to build a professional resume that shows off your best qualities to help you get hired.</p>

			<ul class="pl-3 list-unstyled">
				<li>
					<i class="ion-android-checkbox-outline text-success mr-2 display-5"></i>
					No gimmicks
				</li>
				<li>
					<i class="ion-android-checkbox-outline text-success mr-2 display-5" ></i>
					No sign up
				</li>
				<li>
					<i class="ion-android-checkbox-outline text-success mr-2 display-5" ></i>
					No freemium features
				</li>
			</ul>
			<p>

			</p>
			<a href={{route('resume.build')}} class="btn btn-primary">Build your resume</a>
			<a href="#" class="btn btn-outline-danger ml-2">Download your resume</a>

		</div>
		<div class="col-md-6">
			<div class="banner-img">
				{{-- <img src="{{url('/storage/banner.jpg')}}" class="img-fluid" alt="resume-banner"> --}}
			</div>
		</div>
	</div>
	
	{{-- How it works --}}
	<div class="row my-5 text-center border-bottom">
		<div class="col-lg-12 ">
			<div class="display-4 mb-5">How does resume builder work?</div>
		</div>
		<div class="col-md-4 ">
			<img src="{{url('/storage/resume1.png')}}" class='img-fluid w-25' alt="build image">
			<h6 class="font-weight-bold pt-3 " style="font-size: 1.2rem">Build</h6>
			<p class="px-5">Build a resume quickly using our tool with feature rich options.</p>
		</div>
		<div class=" col-md-4">
			<img src="{{url('/storage/resume2.png')}}" class='img-fluid w-25' alt="build image">
			<h6 class="font-weight-bold pt-3 " style="font-size: 1.2rem">Choose Theme </h6>
			<p class="px-5">Pick from a professionally designed resume template and preview it. </p>
		</div>
		<div class=" col-md-4">
			<img src="{{url('/storage/resume3.png')}}" class='img-fluid w-25' alt="build image">
			<h6 class="font-weight-bold pt-3 " style="font-size: 1.2rem">Save</h6>
			<p class="px-5">Download your new resume and easily use it on personal and professional websites.</p>
		</div>
	</div>
	

	{{-- Template sample --}}
	<div class="row my-5">
		<div class="col-lg-12 text-center display-4 mb-5">Featured Template</div>
		<div class="col-lg-4 ">
			<h1 class="text-warning" style="padding-top:30%; ">Standard</h1>
			A clean style for those who prefer a striking design without a lot of distractions
		</div>
		<div class="col-lg-8 py-3" style="background: #f2f1f0">
			<div class="template-wrapper">
				<img src = "{{url('/storage/template.png')}}" class="img-fluid" alt ="template image">
			</div>
		</div>
	</div>
</div>
