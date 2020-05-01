@extends('adminlte::page')

@section('title', 'Clients | Dashboard')

@section('content_header')

@stop

@section('content')

@php
$url=url('/clients');
$first_name='';
$middle_name='';
$last_name='';
$email='';
$phone='';
$country='';
$city='';
$state='';
$zip='';
$timezone='';
$website='';
$about='';

if(!empty($update) && $update==true){

$url=url('/clients/'.$client->id);
$first_name=$client->first_name;
$middle_name=$client->middle_name;
$last_name=$client->last_name;
$email=$client->email;
$phone=$client->phone;
$country=$client->country;
$city=$client->city;
$state=$client->state;
$zip=$client->zip;
$timezone=$client->timezone;
$website=$client->website;
$about=$client->about;

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
        <h4>{{!empty($update) ? 'Update' : 'Add'}} Client</h4>
    </div>
    <div class="card-body text-center">
        <form action="{{ $url }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="first_name" id="" class="form-control" placeholder="First Name" value="{{ $first_name }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="middle_name" id="" class="form-control" placeholder="Middle Name" value="{{ $middle_name }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="last_name" id="" class="form-control" placeholder="Last Name" value="{{ $last_name }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="tel" name="phone" id="" class="form-control" placeholder="Phone Number" value="{{ $phone }}">
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
                    <input type="text" name="timezone" placeholder="Time Zone" class="form-control" value="{{ $timezone }}">
                </div>
                <div class="col-md-6">
                    <input type="url" name="website" placeholder="Website" class="form-control" value="{{ $website }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="about" id="" cols="30" rows="10" class="form-control" placeholder="About Client">{{$about}}</textarea>
                </div>
            </div>

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