@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <canvas id="ee" width="400" height="300"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="se" width="400" height="300"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <canvas id="invoice" width="400" height="100"></canvas>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $.getJSON( "/finances/invoices/data", function( data ) {
                var labels = [];
                var cost = [];

                var d = new Date();
                var n = d.getMonth();
                var y = d.getYear();

                var daysInMonth = getDaysInMonth(n,y);

                for(var i = 1; i < daysInMonth.length + 1; i++){
                    labels.push(i);
                    cost.push(0);
                }

                for (var obj in data) {
                    if( data.hasOwnProperty(obj) ) {

                        var ts = data[obj].received.split(" ");
                        var d = ts[0].split("-");

                        var index = parseInt(d[2]);

                        cost[index] += data[obj].amount_billed;
                    }
                }

                var totalCosts = [];
                var totalCost = 0;
                for(var i = 0; i < cost.length; i++){
                    totalCost += cost[i];
                    totalCosts.push(totalCost);
                }

                var e_ctx = $("#invoice");
                var supplies = new Chart(e_ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Invoice $',
                            data: totalCosts,
                            backgroundColor: "rgba(153,255,51,0.4)",
                            lineTension: 0,
                        }]
                    }
                });
            });

            $.getJSON( "/finances/expenditures/supplies/data", function( data ) {

                var labels = [];
                var cost = [];

                var d = new Date();
                var n = d.getMonth();
                var y = d.getYear();

                var daysInMonth = getDaysInMonth(n,y);

                for(var i = 1; i < daysInMonth.length + 1; i++){
                    labels.push(i);
                    cost.push(0);
                }

                for (var obj in data) {
                    if( data.hasOwnProperty(obj) ) {
                        var ts = data[obj].created_at.split(" ");
                        var d = ts[0].split("-");

                        var index = parseInt(d[2]);

                        cost[index] += (data[obj].cost * data[obj].total_stock);
                    }
                }

                var totalCosts = [];
                var totalCost = 0;
                for(var i = 0; i < cost.length; i++){
                    totalCost += parseFloat(cost[i]);
                    totalCosts.push(totalCost);
                }

                var e_ctx = $("#se");
                var supplies = new Chart(e_ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Supplies $',
                            data: totalCosts,
                            backgroundColor: "rgba(153,255,51,0.4)",
                            lineTension: 0,
                        }]
                    }
                });
            });

            $(document).ready(function() {

                $.getJSON( "/finances/expenditures/employees/getMonthlyReportWage", function( data ) {
                    var labels = [];
                    var cost = [];

                    var d = new Date();
                    var n = d.getMonth();
                    var y = d.getYear();

                    var daysInMonth = getDaysInMonth(n,y);

                    for(var i = 1; i < daysInMonth.length + 1; i++){
                        labels.push(i);
                        cost.push(0);
                    }

                    for (var obj in data) {
                        if( data.hasOwnProperty(obj) ) {

                            var wage = parseFloat(obj);

                            for(var i = 0; i < data[obj].days.length; i++){
                                var d = data[obj].days[i].split("-");
                                var h = data[obj].hours[i];

                                var index = parseInt(d[2]);
                                cost[index] = wage * h;
                            }
                        }
                    }

                    var totalCosts = [];
                    var totalCost = 0;
                    for(var i = 0; i < cost.length; i++){
                        totalCost += cost[i];
                        totalCosts.push(totalCost);
                    }

                    var e_ctx = $("#ee");
                    var emp = new Chart(e_ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Employee Wage $',
                                data: totalCosts,
                                backgroundColor: "rgba(63,127,191,0.4)",
                                lineTension: 0,
                            }]
                        }
                    });
                });
            } );

            /**
             * @param {int} The month number, 0 based
             * @param {int} The year, not zero based, required to account for leap years
             * @return {Date[]} List with date objects for each day of the month
             */
            function getDaysInMonth(month, year) {
                var date = new Date(year, month, 1);
                var days = [];
                while (date.getMonth() === month) {
                    days.push(new Date(date));
                    date.setDate(date.getDate() + 1);
                }
                return days;
            }

            function randomColour() {
                return '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);
            }

        } );
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Announcements</h1>
            </div>
            <a style="margin-bottom: 20px;" type="button" class="btn btn-primary" href="/announcements/create">Create Announcement</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="announcements" class="table data-table table-striped table-hover" width="100%">
                <thead>
                    <th>Message</th>
                    <th>Announced</th>
                    <th class="no-sort"></th>
                    <th class="no-sort hidden"></th>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ substr($announcement->message, 0, 128) }}...</td>
                            <td>
                                @if ($announcement->announced == null)
                                    Not Published
                                @else {{ $announcement->announced }}
                                @endif
                            </td>
                            <td style="width: 49px;"><a href="/announcements/{{ $announcement->id }}/edit" class="btn btn-default btn-xs">Edit</a></td>
                            <td style="width: 63px;">
                                {{ Form::open(array('url' => 'announcements/' . $announcement->id, 'class' => 'pull-right')) }}
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
@endsection
