@extends('backend.layouts.main')

@section('title')
    About User
@endsection

@section('page-head')
    About User
@endsection

@section('content')
    @include('partials.error')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{Form::model($user, ['method'=>'POST', 'action'=>['BE\AboutUserController@updateAboutUser', auth()->id()]])}}
                    {{-- Name --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                {!! Form::label('fname', 'Firstname :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::text('fname', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::label('lname', 'Lastname :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::text('lname', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>
                    {{-- email --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                {!! Form::label('email', 'Email :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::email('email', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>
                        
                            <div class="col-lg-6">
                                {!! Form::label('contact', 'Contact :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::text('contact', $user->aboutUser->contact ?? "", ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>  
                    </div>
                    {{-- contact --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-8">
                                {!! Form::label('git_url', 'GIT Url :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::text('git_url', $user->aboutUser->git_url ?? "", ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>   
                    </div>
                    {{-- about --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::label('about', 'About :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::textarea('about', $user->aboutUser->about ?? "", ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    {{-- Experience --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::label('experience', 'Experience :', ['class'=>'font-weight-bold']) !!}
                                {!! Form::textarea('experience', $user->aboutUser->experience ?? "", ['class'=>'form-control tiny_mce']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>    
        </div>    
    </div>   
@endsection


@section('footer-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js"></script>
    <script>tinymce.init({
        selector:'.tiny_mce',
        height:500,
        plugins: "lists, wordcount,fullpage, fullscreen, insertdatetime, table, link, fontsizeselect, codesample, code",
        toolbar: 'undo redo | styleselect | bold underline italic | fontsizeselect |alignleft aligncenter alignright alignjustify|bullist numlist| fullscreen link codesample| code',
        browser_spellcheck: true,
        codesample_languages: [
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'Ruby', value: 'ruby'},
            {text: 'Python', value: 'python'},
            {text: 'Java', value: 'java'},
            {text: 'C', value: 'c'},
            {text: 'C#', value: 'csharp'},
            {text: 'C++', value: 'cpp'}
	    ],
        fontsize_formats: '9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 24pt 36pt 48pt'
    });</script>
@endsection