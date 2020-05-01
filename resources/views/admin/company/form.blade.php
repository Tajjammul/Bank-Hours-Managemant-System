@extends('adminlte::page')

@section('title', 'Company | Dashboard')

@section('content_header')

@stop

@section('content')

@php
$url=url('/company');
$name='';
$email='';
$country='';
$city='';
$state='';
$zip='';
$lead_person='';
$website='';

if(!empty($update) && $update==true){

$url=url('/company/'.$company->id);
$name=$company->name;
$email=$company->email;
$country=$company->country;
$city=$company->city;
$state=$company->state;
$zip=$company->zip;
$lead_person=$company->lead_person;
$website=$company->website;

}

@endphp
@if(Session::has('success'))
<div class="row">
    <div class="col-md-12">


        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

    </div>
</div>
@endif
<div class="card">
    <div class="card-header">
        <h4>{{!empty($update) ? 'Update' : 'Add'}} Company</h4>
    </div>
    <div class="card-body text-center">
        <form action="{{ $url }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="name" id="" class="form-control" placeholder="Name" value="{{ $name }}">
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" id="" class="form-control" placeholder="Email Address" value="{{ $email }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="country" placeholder="Country" id="" class="form-control" value="{{ $country }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="city" placeholder="City" id="" class="form-control" value="{{ $city }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="state" placeholder="State" id="" class="form-control" value="{{ $state }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="zip" placeholder="ZIP" id="" class="form-control" value="{{ $zip }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="lead_person" placeholder="Lead Person" class="form-control" value="{{ $lead_person }}">
                </div>
                <div class="col-md-6">
                    <input type="url" name="website" placeholder="Website" class="form-control" value="{{ $website }}">
                </div>
            </div>
            <br>


            <div class="row p-3">
                <div class="col-md-12 text-right">
                    <input type="submit" name="save" class="btn btn-primary px-5" value="{{ !empty($update) ? 'Update' : 'Save' }}">
                </div>
            </div>
            @php
            if(!empty($update) && $update==true){
            @endphp
            @method('put');
            @php
            }
            @endphp
        </form>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop