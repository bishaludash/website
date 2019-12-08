@extends('backend.layouts.main')

@section('title')
    {{env('APP_NAME')}} | Category
@endsection

@section('page-head')
    Category
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card full-screen">
                <div class="card-body">

                    {!! Form::open(['method'=>'POST', 'action'=>'BE\CategoryController@store']) !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    {!! Form::label('cat_name', 'Category : ', ['class'=>'font-weight-bold']) !!}
                                </div>
                                <div class="col-lg-8">
                                    {!! Form::text('cat_name', null, ['class'=>'form-control']) !!}
                                    @if ($errors->has('cat_name'))
                                            <span class="text-danger">{{$errors->first('cat_name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="offset-md-2 col-lg-10">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}


                    Category List
                    <table>
                        @foreach ($categories as $cat)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ucwords($cat->cat_name)}}</td>
                            <td>
                                <a class="btn btn-sm btn-info ajax-modal" style="float: none;" data-title="Edit" 
                                data-url="{{ route('category.edit', $cat->id) }}">
                                        <div class="text-white">Edit</div> 
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger ajax-modal" style="float: none;" data-title="Delete" 
                                data-url="{{ route('category.delete', $cat->id) }}">
                                        <div class="text-white">Delete</div> 
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>


    
@endsection