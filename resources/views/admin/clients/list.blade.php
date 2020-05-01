@extends('adminlte::page')

@section('title', 'Clients | Dashboard')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('clients/create')}}" class="btn btn-primary">New Client</a>
    </div>
</div>
<br>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Clients</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                foreach($clients as $client){
                echo '<tr>';
                    echo '<td>'.$client->first_name.' '.$client->middle_name.' '.$client->last_name.'</td>';
                    echo '<td>'.$client->email.'</td>';
                    echo '<td>'.$client->phone.'</td>';
                    echo '<td>'.$client->website.'</td>';
                    echo '<td><a href="clients/'.$client->id.'/edit">Edit</a> | <a href="javascript::void(0)" onclick="return delete_client('.$client->id.')">Delete</td>';
                    echo '<form id="form_'.$client->id.'" action="clients/'.$client->id.'" method="post">';
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
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
    function delete_client(id) {
        if (confirm('Do you realy want to remove this client?')) {
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