@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Create Invoice</h1>
    </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::open(array('url' => 'finances/invoices')) }}

        <div class="form-group">
            {{ Form::label('amount_billed', 'Bill Total') }}
            {{ Form::number('amount_billed', $value=null,  array('class' => 'form-control', 'min' => 0.00, 'step' => 0.01)) }}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('sent_date', 'Date Sent') }}
                    {{ Form::date('sent_date', $value=null,  array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('sent_time', 'Time Sent') }}
                    {{ Form::time('sent_time', $value=null,  array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('received_date', 'Date Receive') }}
                    {{ Form::date('received_date', $value=null,  array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('received_time', 'Date Received') }}
                    {{ Form::time('received_time', $value=null,  array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('company_name', 'Company') }}
            {{ Form::text('company_name', $value=null, array('class' => 'form-control', 'maxlength' => 50)) }}
        </div>

        {{ Form::hidden('firm_id', $firmID) }}

        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

        {!! Form::close() !!}

@stop