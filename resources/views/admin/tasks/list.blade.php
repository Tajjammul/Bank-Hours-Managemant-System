@extends('adminlte::page')

@section('title', 'Tasks | Dashboard')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('tasks/create')}}" class="btn btn-primary">New Task</a>
    </div>
</div>
<br>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tasks</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Project</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                foreach($tasks as $task){
                echo '<tr>';
                    echo '<td>'.$task->title.'</td>';
                    echo '<td>'.$task->project_name.'</td>';
                    echo '<td>'.$task->progress.' %</td>';
                    echo '<td>'.$task->status.'</td>';
                    echo '<td><a href="tasks/'.$task->id.'/edit">Edit</a> | <a href="javascript::void(0)" onclick="return delete_task('.$task->id.')">Delete</td>';
                    echo '<form id="form_'.$task->id.'" action="tasks/'.$task->id.'" method="post">';
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
                    <th>Project</th>
                    <th>Progress</th>
                    <th>Status</th>
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
    function delete_task(id) {
        if (confirm('Do you realy want to remove this task?')) {
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