@extends('adminlte::page')

@section('title', 'Companies | Dashboard')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('company/create')}}" class="btn btn-primary">New Company</a>
    </div>
</div>
<br>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Companies</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Lead Person</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                foreach($companies as $company){
                echo '<tr>';
                    echo '<td>'.$company->name.'</td>';
                    echo '<td>'.$company->email.'</td>';
                    echo '<td>'.$company->lead_person.'</td>';
                    echo '<td>'.$company->website.'</td>';
                    echo '<td><a href="company/'.$company->id.'/edit">Edit</a> | <a href="javascript::void(0)" onclick="return delete_company('.$company->id.')">Delete</td>';
                    echo '<form id="form_'.$company->id.'" action="company/'.$company->id.'" method="post">';
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
    function delete_company(id) {
        if (confirm('Do you realy want to remove this company?')) {
            $('#form_' + id).submit();
        }
    }

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
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