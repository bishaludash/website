@extends('layouts.main_index')

{{-- Title --}}
@section('title')
{{env('APP_NAME')}} | Edit Resume 
@endsection

@section('blog-css')
<link href={{ asset('css/resume.css') }} rel="stylesheet">
@endsection

@section('blog_head')
@include('resume.layouts.navbar')
@include('resume.layouts.alert')
@endsection

@section('posts')
<div class=" min-view-height">
	<div class="container">
		<p class="font-weight-bold" style="font-size: 1.5rem">Edit resume</p>
		<div class="row">
			<div class="col-lg-10 col-sm-12">
				{!! Form::open(['method'=>'POST', 
				'action'=>['Resume\ResumeEditController@updateResume', $resume['resume_id']], 'files'=>true, 
				// 'class'=>'resume-builder-form',
				'novalidate'=>"novalidate"]) !!}
				{{-- {{dd($resume)}} --}}
				{{-- Form template --}}
				@include('resume.layouts.info')
				@include('resume.layouts.editJobs')
				@include('resume.layouts.editEducation')
				@include('resume.layouts.skills')
				@include('resume.layouts.summary')
				
				<div class="row my-5">
					<div class="col-lg-12">
						{!! Form::submit('Save and Next', ['class'=>'btn btn-success float-right']) !!}
						<a href="{{route('resume.home')}}" class="btn btn-secondary float-right px-5 mr-3">Cancel</a>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			
			<div class="col-lg-2 d-none d-sm-block">
				<div class="sticky-div">
					<div class="btn btn-outline-danger d-block mb-3 toggle-collapse disabled">Collapse All</div>
				</div>
			</div>
		</div>
		
		<!-- Delete Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title" id="exampleModalLabel">Modal title</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="mb-2"> Are you sure you want to delete?</div>
						<div class="card p-2 modal-body-item">
							Lorem ipsum dolor sit amet.
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary commit-action">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
@endsection

@section('footer-js')
<script src="{{asset('admin/js/core/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/core/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js"></script>
<script src="{{asset('js/resume.js')}}"></script>
@endsection