@extends('layouts.main_index')

{{-- Title --}}
@section('title')
{{env('APP_NAME')}} | Resume Builder
@endsection

@section('blog-css')
<link href={{ asset('css/resume.css') }} rel="stylesheet">
@endsection

@section('blog_head')
@include('resume.layouts.navbar')
@endsection

@section('posts')
<div class=" min-view-height">
	<div class="container">
		<p class="font-weight-bold" style="font-size: 1.5rem">Build your resume</p>
		<div class="row">
			<div class="col-lg-12">
				
				{!! Form::open(['method'=>'POST', 'action'=>'Resume\ResumeController@saveBuild', 'files'=>true]) !!}

				@include('resume.layouts.info')
				@include('resume.layouts.jobs')
				@include('resume.layouts.education')
				
				<div class="card my-5 shadow">
					<div class="card-body resume-section bg-resume-section" data-toggle="collapse" data-target="#collapse-skills" >
						<div class="text-danger display-5" >
							Skill
							<span class="float-right"><i class="ion-minus-circled"></i></span>
						</div>
						<div class="text-danger">Next, let’s take care of your skills.</div>
					</div>
					<div id="collapse-skills" class="collapse show">	
						<div class="card-body">
							
							<div class="row">
								<div class="col-md-8">
									<div class="form-group disabled">
										{!! Form::label('skills', 'Skills')!!}
										{!! Form::textarea('skills', null,['class'=>'form-control']) !!}
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="card my-5 shadow">
					<div class="card-body resume-section bg-resume-section" data-toggle="collapse" data-target="#collapse-summary" >
						<div class="text-danger display-5" >
							Summary
							<span class="float-right"><i class="ion-minus-circled"></i></span>
						</div>
						<div class="text-danger">Finally, let’s work on your summary.</div>
					</div>
					<div id="collapse-summary" class="collapse show">
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group disabled">
										{!! Form::label('user_summary', 'Summary')!!}
										{!! Form::textarea('user_summary', null,['class'=>'form-control']) !!}
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row my-5">
					<div class="col-lg-12">
						{!! Form::submit('Save and Next', ['class'=>'btn btn-success float-right']) !!}
						<div class="btn btn-secondary float-right px-5 mr-3">Cancel</div>
						
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>	
</div>
@endsection

@section('footer-js')
<script src="{{asset('admin/js/core/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/core/popper.min.js')}}"></script>
<script src="{{asset('admin/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/resume.js')}}"></script>
@endsection