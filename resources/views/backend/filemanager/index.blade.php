@extends('backend.layouts.main')

@section('title')
{{env('APP_NAME')}} | Post
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('page-head')
Files List
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body table-responsive">
                {{-- Data table --}}
                
                <div style="overflow-x:auto;">
                    <table class="table table-bordered table-hover" id="datatable"> {{-- id="datatable" --}}
                        <thead>
                            <tr>
                                <th class="border">File</th>
                                <th class="border">source</th>
                                <th class="border">Extension</th>
                                <th class="border">size</th>
                                <th class="border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                            <tr>
                                <td>
                                    {{$file['file_name']}}
                                </td>
                                <td>{{$file['source']}}</td>
                                <td>{{$file['extension']}}</td>
                                <td>{{$file['file_size']}}</td>
                                <td>        
                                    <a class="btn btn-sm btn-danger ajax-modal" style="float: none;" data-title="Delete" 
                                    data-url="{{ route('file.delete', $file['id']) }}">
                                    <div class="text-white">Delete</div> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div><!-- /.blog-main -->
        </div>
    </div>
</div>
@endsection

@section('footer-js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable({
            
        });
    });
</script>
@endsection