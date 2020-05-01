@extends('adminlte::page')

@section('title', 'Projects | Dashboard')

@section('content_header')

@stop

@section('content')

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('projects/create')}}" class="btn btn-primary">New Project</a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Projects</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Live URL</th>
                    <th>Staging URL</th>
                    <th>Git</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                foreach($projects as $project){
                echo '<tr>';
                    echo '<td>'.$project->name.'</td>';
                    echo '<td>'.$project->live_url.'</td>';
                    echo '<td>'.$project->staging_url.'</td>';
                    echo '<td>'.$project->git.'</td>';
                    echo '<td><a href="projects/'.$project->id.'/edit">Edit</a> | <a href="javascript::void(0)" onclick="return delete_project('.$project->id.')">Delete</td>';
                    echo '<form id="form_'.$project->id.'" action="projects/'.$project->id.'" method="post">';
                        @endphp
                        @csrf
                        @method('delete')
                        @php
                        echo '</form>';
                    echo '</tr>';
                }

                @endphp


            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Live URL</th>
                    <th>Staging URL</th>
                    <th>Git</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
@stop

@section('js')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
    function delete_project(id) {
        if (confirm('Do you realy want to remove this project?')) {
            $('#form_' + id).submit();
        }
    }

    $(function() {

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@stop