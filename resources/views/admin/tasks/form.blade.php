@extends('adminlte::page')

@section('title', 'Tasks | Dashboard')

@section('content_header')

@stop


@php

$url=url('tasks');
$title="";
$description="";
$status="";
$progress="";
$consumed_hours=0;
$consumed_mins=0;
$project_id="";
$parent_id="";

if(!empty($update) && $update==true){

$url=url('tasks/'.$task->id);
$title=$task->title;
$description=$task->description;
$status=$task->status;
$progress=$task->progress;
$consumed_hours=$task->consumed_hours;
$consumed_mins=$task->consumed_hours;
$project_id=$task->project_id;
$parent_id=$task->parent_id;

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
        <h4>{{!empty($update) ? 'Update' : 'Add'}} Task</h4>
    </div>
    <div class="card-body text-center">
        <form action="{{$url}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="title" id="" class="form-control" placeholder="Name" value="{{$title}}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" name="progress" min="0" max="100" value="{{$progress}}" class="form-control" placeholder="Progress (%)">
                </div>
                <div class="col-md-6">
                    <input type="text" name="status" value="{{$status}}" class="form-control" placeholder="Status">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" name="consumed_hours" min="0" id="" value={{$consumed_hours}} class="form-control" placeholder="Consumed Hours">
                </div>
                <div class="col-md-6">
                    <input type="number" name="consumed_mins" min="0" id="" value={{$consumed_mins}} class="form-control" placeholder="Consumed Minutes">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-6">
                    <select name="project" id="owner" class="form-control">
                        <option value="">-- Select Project --</option>
                        @php
                        foreach($projects as $project){
                        @endphp
                        <option value={{$project->id}} {{ $project_id==$project->id ? 'selected=selected' : '' }}>{{ $project->name }}</option>
                        @php
                        }
                        @endphp
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="parent" id="client" class="form-control">
                        <option value="">-- Parent Task --</option>
                        @php
                        foreach($tasks as $task){
                        @endphp
                        <option value={{$task->id}} {{ $parent_id==$task->id ? 'selected=selected' : '' }}>{{ $task->title }}</option>
                        @php
                        }
                        @endphp
                    </select>
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


@stop