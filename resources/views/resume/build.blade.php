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
				<div class="card shadow">
					<div class="card-body">
						<div class="text-danger display-5" data-toggle="collapse" data-target="#collapseOne" >
							Personal Info
						</div>
						<div class="text-danger">What’s the best way for employers to contact you?</div>
					</div>					
					<div id="collapseOne" class="collapse show">
						<div class="card-body">
							
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('first_name', 'First Name *') !!}
											{!! Form::text('first_name', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('last_name', 'Last Name *') !!}
											{!! Form::text('last_name', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
								</div>					
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('city', 'City') !!}
											{!! Form::text('city', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('state_province', 'State/Province') !!}
											{!! Form::text('state_province', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('zip', 'Zip') !!}
											{!! Form::text('zip', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('phone', 'Phone') !!}
											{!! Form::text('phone', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('email', 'Email') !!}
											{!! Form::text('email', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="card my-5 shadow">
					<div class="card-body">
						<div class="text-danger display-5" data-toggle="collapse" data-target="#collapse-work" >
							Work Experience
						</div>
						<div class="text-danger">Now, let’s fill out your work history</div>
					</div>
					<div id="collapse-work" class="collapse show">	
						<div class="card-body">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('job_title', 'Job Title') !!}
											{!! Form::text("job[title][]", null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('job_title', 'Job Title') !!}
											{!! Form::text("job[title][]", null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('employer', 'Employer') !!}
											{!! Form::text("job[employer][]", null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('employer', 'Employer') !!}
											{!! Form::text("job[employer][]", null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('job[city][0]', 'City') !!}
											{!! Form::text('job[city][0]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('job[city][1]', 'City') !!}
											{!! Form::text('job[city][1]', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											{!! Form::label('start_date', 'Start Date') !!}
											{!! Form::date('start_date', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group disabled">
											{!! Form::label('end_date', 'End Date') !!}
											{!! Form::date('end_date', null, ['class'=>'form-control', 'autocomplete'=>'off', 'disabled'=>true]) !!}
										</div>
										
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheck1" checked=true>
											<label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
										</div>
										
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-8">
										<div class="form-group disabled">
											{!! Form::label('job_details', 'Job Details')!!}
											{!! Form::textarea('job_details', null,['class'=>'form-control']) !!}
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12 text-center">
									<div class="btn btn-outline-primary w-100 ">Add another position</div>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
				
				
				<div class="card my-5 shadow">
					<div class="card-body">
						<div class="text-danger display-5" data-toggle="collapse" data-target="#collapse-education" >
							Education
						</div>
						<div class="text-danger">Great, let’s work on your education</div>
					</div>
					<div id="collapse-education" class="collapse show">	
						<div class="card-body">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('school_name', 'School Name') !!}
											{!! Form::text('school_name', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
										
									</div>	
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('school_location', 'School Location') !!}
											{!! Form::text('school_location', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>								
								</div>
								
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('degree', 'Degree') !!}
											{!! Form::text('degree', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											{!! Form::label('field_of_stydy', 'Field of Study') !!}
											{!! Form::text('field_of_stydy', null, ['class'=>'form-control', 'autocomplete'=>'off', 'maxlength'=>25]) !!}
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group disabled">
											{!! Form::label('start_year', 'Start Year') !!}
											{!! Form::date('start_year', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
										</div>
										
									</div>
									
									<div class="col-lg-3">
										<div class="form-group disabled">
											{!! Form::label('end_year', 'End Year') !!}
											{!! Form::date('end_year', null, ['class'=>'form-control', 'autocomplete'=>'off', 'disabled'=>true]) !!}
										</div>
										
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheck1" checked=true>
											<label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
										</div>
										
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-lg-12 text-center">
									<div class="btn btn-outline-primary w-100 ">Add another position</div>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
				
				<div class="card my-5 shadow">
					<div class="card-body">
						<div class="text-danger display-5" data-toggle="collapse" data-target="#collapse-skills" >
							Education
						</div>
						<div class="text-danger">Next, let’s take care of your skills.</div>
					</div>
					<div id="collapse-skills" class="collapse show">	
						<div class="card-body">
							
							<div class="row">
								<div class="col-md-8">
									<div class="form-group disabled">
										{!! Form::label('job_details', 'Job Details')!!}
										{!! Form::textarea('job_details', null,['class'=>'form-control']) !!}
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="card my-5 shadow">
					<div class="card-body">
						<div class="text-danger display-5" data-toggle="collapse" data-target="#collapse-summary" >
							Summary
						</div>
						<div class="text-danger">Finally, let’s work on your summary.</div>
					</div>
					<div id="collapse-summary" class="collapse show">
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group disabled">
										{!! Form::label('job_details', 'Job Details')!!}
										{!! Form::textarea('job_details', null,['class'=>'form-control']) !!}
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
@endsection