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
                
                @include('backend.category.create')                
                
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>S.N</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($categories as $cat)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{route('cat.show', $cat->id)}}" target="_blank" class="text-dark d-block">
                            {{ucwords($cat->cat_name)}}</a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info ajax-modal" style="float: none;" data-title="Edit" 
                            data-url="{{ route('category.edit', $cat->id) }}">
                            <div class="text-white">Edit</div> </a>
                            
                            <a class="btn btn-sm btn-danger ajax-modal" style="float: none;" data-title="Delete" 
                            data-url="{{ route('category.delete', $cat->id) }}">
                            <div class="text-white">Delete</div> </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                
            </div>
        </div>
    </div>
</div>



@endsection