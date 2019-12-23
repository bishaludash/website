@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Project
@endsection

{{-- PAGE HEADING --}}
@section('page-head')
<a class="navbar-brand" href="#pablo">Project</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <a href="{{route('projects.create')}}" class="btn btn-primary btn-sm">New Project</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-h">
            <div class="card-body">
                
                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th class="border">Title</th>
                            <th class="border">Created Date</th>
                            <th class="border">Status</th>
                            <th class="border">Actions</th>
                            <th class="border p-0 m-0" style="visibility:hidden"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $item)
                        <tr>
                            <td><a href="{{ route('projects.show', $item['id']) }}" class="text-dark d-block">
                                {{$item['project_title']}}</a>
                            </td>
                            <td>{{$item['created_at']->format('M d, Y')}}</td>
                            <td>
                                {!!$item['is_archived'] ? 
                                "<span class='btn btn-warning btn-sm'>Unarchive</span>" : "<span class='btn btn-warning btn-sm'>Archive</span>" !!}
                            </td>
                            <td>
                                <a href="{{route('projects.edit', $item['id'])}}" class="btn btn-sm btn-primary">Edit</a>
                                
                                <a class="btn btn-sm btn-danger text-white ajax-modal" style="float: none;" data-title="Delete" 
                                data-url="{{ route('projects.delete',  $item['id']) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection