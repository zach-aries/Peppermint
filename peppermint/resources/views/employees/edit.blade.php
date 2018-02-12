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

        {{ Form::model($employee, array('route' => array('employees.update', $employee->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('fname', 'First Name') }}
            {{ Form::text('fname', $value=null,  array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('lname', 'Last Name') }}
            {{ Form::text('lname', $value=null,  array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', $value=null,  array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            {{ Form::label('password-confirm', 'Password Confirm') }}
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
            {{ Form::label('sin', 'SIN (xxxxxxxxx)') }}
            {{ Form::text('sin', $value=null, array('class' => 'form-control', 'maxlength' => 9)) }}
        </div>

        <div class="form-group">
            {{ Form::label('phone_number', 'Phone Number (xxx-xxx-xxxx)') }}
            {{ Form::text('phone_number', $value=null, array('class' => 'form-control', 'maxlength' => 12 )) }}
        </div>

        <div class="form-group">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', $value=null,  array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('wage', 'Wage') }}
            {{ Form::number('wage', $value=null,  array('class' => 'form-control', 'min' => 1)) }}
        </div>

        {{ Form::hidden('firm_id', $firmID) }}

        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

        {!! Form::close() !!}
    </div>
@stop