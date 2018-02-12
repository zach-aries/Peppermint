@extends('layouts.employee-app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Dashboard</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @foreach ($announcements as $announcement)
            @if( $announcement->announced != null )
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{$announcement->announced}}</strong>
                    <p>{{ $announcement->message  }}</p>
                </div>
            @endif
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        @if ($between_shift)
            <div class="col-md-6">
                <div class="jumbotron">
                    @if($punched_out)
                        <h2>Your shift has been recorded</h2>
                        <hr>
                    @elseif ($punched_in)
                        <h2 style="margin-top: 41px; text-align: center;">Punch Out Below:</h2>
                        <hr>
                        <p>
                            {{ Form::open(array('url' => '/schedule/punchout/' . $eventid,)) }}
                            {{ Form::hidden('_method', 'POST') }}
                            {{ Form::submit('Punch Out', array( 'style'=>'width: 100%','class' => 'btn btn-primary btn-lg')) }}
                            {{ Form::close() }}
                        </p>
                    @elseif (!$punched_in)
                        <h2 style="margin-top: 41px; text-align: center;">Punch In Below:</h2>
                        <hr>
                        <p>
                            {{ Form::open(array('url' => '/schedule/punchin/' . $eventid,)) }}
                            {{ Form::hidden('_method', 'POST') }}
                            {{ Form::submit('Punch In', array('style'=>'width: 100%','class' => 'btn btn-primary btn-lg')) }}
                            {{ Form::close() }}
                        </p>

                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="jumbotron">
                    <div class="alert alert-success" role="alert">Shift Available</div>
                    <ul class="list-group">
                        <li class="list-group-item">Start Time: <span class="pull-right">{{ $shiftstart }}</span></li>
                        <li class="list-group-item">End Time: <span class="pull-right">{{ $shiftend }}</span></li>
                    </ul>
                </div>
            </div>
        @else
            <div class="col-md-6">
                <div class="alert alert-warning" role="alert">No Shift Available</div>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <h1>Finances</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <h2><small>Current Month</small></h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Hours</th>
                    <th>Salary</th>
                    <th style="text-align: right;">Earned Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $total_hours }}</td>
                    <td>${{ $employee->wage }}</td>
                    <td style="text-align: right;">${{ $total_hours * $employee->wage }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-8">
        <canvas id="salary" width="400" height="150"></canvas>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Schedule</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-hover data-table">
            <thead>
            <th>Scheduled Start</th>
            <th>Scheduled End</th>
            <th>Punched In</th>
            <th>Punched Out</th>
            </thead>
            <tbody>
            @foreach ($schedule as $event)
                <tr>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->end }}</td>
                    <td>{{ $event->punched_in }}</td>
                    <td>{{ $event->punched_out }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $.getJSON( "/employees/getmonthhours", function( data ) {
            console.log(data.hours);


            var e_ctx = $("#salary");
            var expenditures = new Chart(e_ctx, {
                type: 'line',
                data: {
                    labels: data.days,
                    datasets: [{
                        label: 'hours',
                        data: data.hours,
                        backgroundColor: "rgba(153,255,51,0.4)",
                        lineTension: 0,
                    }]
                }
            });
        });
    } );
</script>
@endsection


