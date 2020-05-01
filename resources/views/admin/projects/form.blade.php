@extends('adminlte::page')

@section('title', 'Project | Dashboard')

@section('content_header')

@stop


@php

$url=url('projects');
$name="";
$staging="";
$live="";
$git="";
$description="";
$owner="";
$sel_client="";
$sel_company="";

if(!empty($update) && $update==true){

$url=url('projects/'.$project->id);
$name=$project->name;
$staging=$project->staging_url;
$live=$project->live_url;
$git=$project->git;
$description=$project->description;
if(!empty($client->client_id)){
$owner='client';
}else if(!empty($company->company_id)){
$owner='company';
}else{
$owner="";
}
$sel_client=!empty($client->client_id) ? $client->client_id : '';
$sel_company=!empty($company->company_id) ? $company->company_id : '';

}

@endphp


@section('content')
@if(Session::has('success'))

<div class="row">
    <div class="col-md-12">


        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

    </div>
</div>
@endif
<div class="card">
    <div class="card-header">
        <h4>{{!empty($update) ? 'Update' : 'Add'}} Project</h4>
    </div>
    <div class="card-body text-center">
        <form action="{{$url}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="name" id="" class="form-control" placeholder="Name" value="{{$name}}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="url" name="staging_url" id="" class="form-control" placeholder="Staging URL" value="{{ $staging }}">
                </div>
                <div class="col-md-4">
                    <input type="url" name="live_url" id="" class="form-control" placeholder="Live URL" value="{{ $live }}">
                </div>
                <div class="col-md-4">
                    <input type="url" name="git" id="" class="form-control" placeholder="Git" value="{{ $git }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Description">{{$description}}</textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <select name="owner" id="owner" class="form-control">
                        <option value="">-- Select Type --</option>
                        <option value="client" {{ $owner=='client' ? 'selected=selected' : '' }}>Client</option>
                        <option value="company" {{ $owner=='company' ? 'selected=selected' : '' }}>Company</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="client" id="client" class="form-control" style="{{ ($owner=='client') ? '' : 'display:none' }}">
                        <option value="">-- Select Client --</option>
                        @foreach($clients as $cl)
                        <option value="{{$cl->id}}" {{ $sel_client== $cl->id ? 'selected=selected' : '' }}>{{$cl->first_name." ".$cl->middle_name." ".$cl->last_name}}</option>
                        @endforeach
                    </select>

                    <select name="company" id="company" class="form-control" style="{{ ($owner=='company') ? '' : 'display:none' }}" }}>
                        <option value="">-- Select Company --</option>
                        @foreach($companies as $co)
                        <option value="{{$co->id}}" {{ $sel_company== $co->id ? 'selected=selected' : '' }}>{{$co->name}} ({{$co->lead_person}})</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <br>
            <div class="row">
                <div class="col-md-12">
                    <input type="file" name="rel_doc" id="" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                </div>
            </div>

            @if(!empty($update) && $update==true)
            @method('put')
            @endif
        </form>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#owner').on('change', function() {
            let owner = $(this).val();
            if (owner == 'client') {
                $('#company').hide();
                $('#client').show();
            } else if (owner == 'company') {
                $('#client').hide();
                $('#company').show();
            } else {
                $('#client').hide();
                $('#company').hide();
            }
        })
    })
</script>

@stop