@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Edit Supplies</h1>
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

        {{ Form::model($supply, array('route' => array('supplies.update', $supply->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('type', 'Type') }}
            {{ Form::text('type', $value=null,  array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('total_stock', 'Total Stock') }}
            {{ Form::number('total_stock', $value=null,  array('class' => 'form-control', 'min' => 0.00, 'step' => '0.01')) }}
        </div>

        <div class="form-group">
            {{ Form::label('cost', 'Cost') }}
            {{ Form::number('cost', $value=null, array('class' => 'form-control', 'min' => 0.00, 'step' => '0.01')) }}
        </div>

        <div class="form-group">
            {{ Form::label('in_stock', 'Current Stock') }}
            {{ Form::number('in_stock', $value=null, array('class' => 'form-control', 'min' => 0, 'step' => '1')) }}
        </div>

        <div class="form-group">
            {{ Form::label('num_ordered', 'Quantity Ordered') }}
            {{ Form::number('num_ordered', $value=null,  array('class' => 'form-control', 'min' => 0, 'step' => '1')) }}
        </div>


        {{ Form::hidden('firm_id', $firmID) }}

        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

        {!! Form::close() !!}
    </div>



@stop