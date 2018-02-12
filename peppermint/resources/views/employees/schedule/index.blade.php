@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1><span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $employee->fname }} {{ $employee->lname }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="page-header">
                    <a style="margin-bottom" type="button" class="btn btn-primary" href="/employees/schedule/{{ $employee->id }}/create">Add Event</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Scheduled Start</th>
                    <th>Scheduled End</th>
                    <th>Punched In</th>
                    <th>Punched Out</th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                </thead>
                <tbody>
                @foreach ($schedule as $event)
                    <tr>
                        <td>{{ $event->start }}</td>
                        <td>{{ $event->end }}</td>
                        <td>{{ $event->punched_in }}</td>
                        <td>{{ $event->punched_out }}</td>
                        <td style="width: 49px;"><a href="/employees/schedule/{{ $employee->id }}/edit/{{ $event->id }}/edit" class="btn btn-default btn-xs">Edit</a></td>
                        <td style="width: 63px;">
                            {{ Form::open(array('url' => 'employees/schedule/'.$employee->id.'/' . $event->id , 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

