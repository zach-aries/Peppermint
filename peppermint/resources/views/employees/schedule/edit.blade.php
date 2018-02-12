@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Edit Employee</h1>
    </div>

    <div class="row">

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::model($event, array('route' => array('schedule.update', $event->id), 'method' => 'PUT')) }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('start_date', 'Start Date') }}
                        {{ Form::date('start_date', $value=null,  array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('start_time', 'Start Time') }}
                        {{ Form::time('start_time', $value=null,  array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('end_date', 'End Date') }}
                        {{ Form::date('end_date', $value=null,  array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('end_time', 'End Time') }}
                        {{ Form::time('end_time', $value=null,  array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            {{ Form::hidden('employee_id', $employee->id) }}

        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

        {!! Form::close() !!}
    </div>
@stop