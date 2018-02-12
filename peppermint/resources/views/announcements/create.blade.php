@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Create Announcement</h1>
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

        {{ Form::open(array('url' => 'announcements')) }}

        <div class="form-group">
            {{ Form::label('message', 'Message') }}
            {{ Form::textarea('message', $value=null,  array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('publish', 'Publish Message') }}
            {{ Form::checkbox('publish', $value=null,  array('class' => 'form-control')) }}
        </div>

        {{ Form::hidden('admin_id', $adminID) }}

        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

        {!! Form::close() !!}
    </div>
@stop